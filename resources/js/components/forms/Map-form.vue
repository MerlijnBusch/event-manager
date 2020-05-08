<template>
    <div class="map-container">
        <div class="map-settings-container">
            <button class="button-create-item map-settings-container-items" v-on:click="addNewItem">AddNewItem</button>
            <div class="map-settings-container-items">
                <label for="select-color">Select color</label>
                <input type="color" name="select-color" id="select-color" v-bind:value="this.backgroundColorCodeItem"
                       @change="setItemBackgroundColorData($event)"/>
            </div>
            <button class="button-create-item map-settings-container-items" v-on:click="storeMap">Create Map</button>
            <button class="button-create-item map-settings-container-items" v-on:click="clearMap">Clear map</button>
        </div>
        <div class="map-holder" ref="mapHolder"></div>
    </div>
</template>

<script>
    import axios from 'axios';
    import interact from 'interactjs'
    import create from 'dom-create-element';

    /** @todo display this is the front end a popup for if the user forgets
     double tap items on box to delete item,
     when color is selected and items is holden it will change that items color,
     when items is tapped it will take the see that as the selected item when the copy state is on true
     key ctrl + c start copy state
     key ctrl + v start copying items and copy state on false in case user mis clicks
     key ctrl + z undo last item from copy state
     key escape to stop the copy state and clear the copy item
     */

    export default {
        data() {
            return {
                event_id: this.$route.params.event_id,
                items: [],
                backgroundColorCodeItem: "#2195e8",
                counter: 0,
                copyState: false,
                copyItem: {},
                timeoutPaste: undefined,
                timeoutUndo: undefined,
            }
        },
        methods: {
            init() {
                interact('.draggable')
                    .resizable({
                        edges: {left: true, right: true, bottom: true, top: true},
                        listeners: {
                            move: this.resizeElement,
                            end: this.setDragPosition,
                        },
                        modifiers: [
                            interact.modifiers.restrictEdges({
                                outer: 'parent'
                            }),
                            interact.modifiers.restrictSize({
                                min: {width: 20, height: 20}
                            })
                        ],

                        inertia: true
                    })
                    .draggable({
                        inertia: true,
                        modifiers: [
                            interact.modifiers.restrictRect({
                                restriction: 'parent',
                                endOnly: true
                            }),
                            interact.modifiers.snap({
                                targets: [
                                    interact.createSnapGrid({x: 20, y: 20})
                                ],
                                range: Infinity,
                                relativePoints: [{x: 0, y: 0}]
                            }),
                        ],
                        autoScroll: true,
                        listeners: {
                            move: this.updatePosition,
                            end: this.setDragPosition,
                        }
                    })
                    .on('doubletap', function (e) {
                        if (confirm('Wilt u dit item verweideren')) {
                            const id = e.target.id
                            e.target.parentNode.removeChild(e.target);
                            window.dispatchEvent(new CustomEvent('delete-item', {detail: id}));
                        }
                        e.preventDefault()
                    })
                    .on('hold', function (event) {
                        window.dispatchEvent(new CustomEvent('update-background-color', {detail: event}));
                    })
                    .on('tap', function (event) {
                        window.dispatchEvent(new CustomEvent('set-copied-item', {detail: event}));
                    })
                window.addEventListener('delete-item', this.deleteItemFromArray, false);
                window.addEventListener('update-background-color', this.updateItemBackgroundColor, false);
                window.addEventListener('keydown', this.startCopyPasteState, false);
                window.addEventListener('set-copied-item', this.setCopyPasteItem, false);
            },
            updatePosition(event) {
                let target = event.target
                let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
                let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy
                target.style.webkitTransform =
                    target.style.transform =
                        'translate(' + x + 'px, ' + y + 'px)'
                target.setAttribute('data-x', x)
                target.setAttribute('data-y', y)
            },
            addNewItem() {
                this.items.push(this.generateItemObject());
                const container = this.$refs.mapHolder;
                container.appendChild(this.createNewDomElement());
            },
            createNewDomElement(backgroundColorCodeItem = this.backgroundColorCodeItem, width = 150, height = 150) {
                const item = create({
                    selector: 'div',
                    id: `stand-id-${this.counter}`,
                    styles: 'draggable',
                    children: create({
                        selector: 'p',
                        html: `stand-id-${this.counter}`,
                    })
                });
                item.style.backgroundColor = backgroundColorCodeItem;
                item.style.width = width + "px";
                item.style.height = height + "px";
                return item;
            },
            deleteItemFromArray(event) {
                this.items = this.items.filter((obj) => {
                    return obj.id !== event.detail;
                });
                this.counter--;
            },
            setDragPosition(event) {
                setTimeout(() => {
                    this.items.forEach((element, index) => {
                        if (element.id === event.target.id) {
                            this.items[index].positionFromParent.x = parseInt(event.target.getAttribute('data-x'));
                            this.items[index].positionFromParent.y = parseInt(event.target.getAttribute('data-y'));
                            this.items[index].style.width = event.target.getBoundingClientRect().width;
                            this.items[index].style.height = event.target.getBoundingClientRect().height;
                        }
                    });
                }, 100)
            },
            resizeElement(event) {
                let target = event.target
                let x = (parseFloat(target.getAttribute('data-x')) || 0)
                let y = (parseFloat(target.getAttribute('data-y')) || 0)
                target.style.width = event.rect.width + 'px'
                target.style.height = event.rect.height + 'px'
                x += event.deltaRect.left
                y += event.deltaRect.top
                target.style.webkitTransform = target.style.transform =
                    'translate(' + x + 'px,' + y + 'px)'
                target.setAttribute('data-x', x)
                target.setAttribute('data-y', y)
            },
            setItemBackgroundColorData(event) {
                this.backgroundColorCodeItem = event.target.value;
            },
            updateItemBackgroundColor(event) {
                let el = event.detail.target;
                el.style.backgroundColor = this.backgroundColorCodeItem
                setTimeout(() => {
                    this.items.forEach((element, index) => {
                        if (element.id === el.id) this.items[index].style.backgroundColor = this.backgroundColorCodeItem;
                    });
                }, 100)
            },
            startCopyPasteState(event) {
                if (event.code === "KeyC" && event.ctrlKey === true) {
                    this.copyState = true;
                }
                if (event.code === "KeyV" && event.ctrlKey === true && this.copyItem.id !== undefined) {
                    this.copyState = false; // set copy state on false and start pasting the items
                    if (this.timeoutPaste === undefined) {
                        this.items.push(this.generateItemObject(
                            this.copyItem.style.width,
                            this.copyItem.style.height,
                            this.copyItem.positionFromParent.x,
                            this.copyItem.positionFromParent.y,
                            this.copyItem.style.backgroundColor
                        ));
                        const container = this.$refs.mapHolder;
                        container.appendChild(this.createNewDomElement(
                            this.copyItem.style.backgroundColor,
                            this.copyItem.style.width,
                            this.copyItem.style.height
                        ));
                        this.timeoutPaste = setTimeout(() => {
                            this.timeoutPaste = undefined;
                        }, 500)
                    }
                }
                if (event.code === "KeyZ" && event.ctrlKey === true && this.copyItem.id !== undefined) {
                    if(this.items[this.items.length -1].id !== "stand-id-3" && this.timeoutUndo === undefined) {
                        this.items.pop();
                        this.timeoutUndo = setTimeout(() => {
                            this.timeoutUndo = undefined;
                        }, 500)
                    }
                }
                if (event.code === "Escape") {
                    this.clearCopyState();
                }
            },
            clearCopyState() {
                this.copyState = false; // clear copy state
                this.copyItem = {};
            },
            setCopyPasteItem(event) {
                if (this.copyState) this.copyItem = this.items.find(el => el.id === event.detail.target.id)
            },
            generateItemObject(width = 100, height = 100, x = 0, y = 0, backgroundColorCodeItem = this.backgroundColorCodeItem) {
                this.counter++;
                return {
                    id: `stand-id-${this.counter}`,
                    user_id: undefined,
                    style: {
                        width: width,
                        height: height,
                        backgroundColor: backgroundColorCodeItem,
                    },
                    positionFromParent: {
                        x: x,
                        y: y,
                    }
                }
            },
            storeMap() {
                const headers = {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + this.$user.data.api_token
                }
                const data = {
                    "name": "some map name for now to test",
                    "json": JSON.stringify(this.items),
                    "event_id": this.event_id,
                }
                axios.post(window.location.origin + `/api/map`, data, {headers: headers}).then(response => {
                    if (response.status === 200) {
                        console.log('success', response)
                    }
                }).catch(e => {
                    this.errors.push(e)
                })
            },
            clearMap() {
                if (!confirm('Weet u zeker dat u de map wilt leeg maken')) return null;
                const container = this.$refs.mapHolder;
                container.innerHTML = '';
                this.counter = 0;
                this.items = [];
                this.clearCopyState();
            }
        },
        mounted() {
            this.deleteItemFromArray = this.deleteItemFromArray.bind(this)
            this.updateItemBackgroundColor = this.updateItemBackgroundColor.bind(this)
            this.startCopyPasteState = this.startCopyPasteState.bind(this);
            this.setCopyPasteItem = this.setCopyPasteItem.bind(this);
            this.init()
        },
        beforeDestroy() {
            this.clearCopyState();
            window.removeEventListener('delete-item', this.deleteItemFromArray, false);
            window.removeEventListener('update-background-color', this.updateItemBackgroundColor, false);
            window.removeEventListener('keydown', this.startCopyPasteState, false);
            window.removeEventListener('set-copied-item', this.setCopyPasteItem, false);
        }
    }
</script>

<style>
    .map-container {
        display: flex;
        flex-direction: row;
        width: 100%;
    }

    .map-holder {
        width: 1500px;
        height: 2000px;
        background-color: lightgray;
    }

    .draggable {
        position: absolute;
        color: white;
        touch-action: none;
        user-select: none;
        -webkit-transform: translate(0px, 0px);
        transform: translate(0px, 0px);
    }

    .map-settings-container {
        width: 200px;
        display: flex;
        justify-content: flex-start;
        flex-direction: column;
        padding: 8px;
    }

    .button-create-item {
        height: 30px;
    }

    .map-settings-container-items {
        padding-top: 4px;
        padding-bottom: 4px;
        width: 100%;
    }
</style>
