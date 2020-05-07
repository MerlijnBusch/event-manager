<template>
    <div class="map-container">
        <div class="map-settings-container">
            <button class="button-create-item" v-on:click="addNewItem">AddNewItem</button>
        </div>
        <div class="map-holder" ref="mapHolder"></div>
    </div>
</template>

<script>
    import axios from 'axios';
    import interact from 'interactjs'
    import create from 'dom-create-element';

    export default {
        data() {
            return {
                items: [],
                counter: 0,
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
                                    interact.createSnapGrid({ x: 20, y: 20 })
                                ],
                                range: Infinity,
                                relativePoints: [ { x: 0, y: 0 } ]
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
                            console.log(e)
                            const id = e.target.id
                            e.target.parentNode.removeChild(e.target);
                            window.dispatchEvent(new CustomEvent('delete-item', {detail: id}));
                        }
                        e.preventDefault()
                    })
                window.addEventListener('delete-item', this.deleteItemFromArray, false);
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
                const newItem = {
                    id: `stand-id-${this.counter}`,
                    name: 'some item wowow',
                    style: {
                        width: 150,
                        height: 150,
                    },
                    positionFromParent: {
                        x: 0,
                        y: 0,
                    }
                }
                this.items.push(newItem);
                const container = this.$refs.mapHolder;
                container.appendChild(this.createNewDomElement());
                this.counter++;
            },
            createNewDomElement() {
                return create({
                    selector: 'div',
                    id: `stand-id-${this.counter}`,
                    styles: 'draggable',
                    children: create({
                        selector: 'p',
                        html: `stand-id-${this.counter}`,
                    })
                });
            },
            deleteItemFromArray(event) {
                this.items = this.items.filter((obj) => {
                    return obj.id !== event.detail;
                });
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
            }
        },
        mounted() {
            this.deleteItemFromArray = this.deleteItemFromArray.bind(this)
            this.init()
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
        width: 150px;
        height: 150px;
        background-color: #29e;
        color: white;
        touch-action: none;
        user-select: none;
        -webkit-transform: translate(0px, 0px);
        transform: translate(0px, 0px);
    }

    .map-settings-container{
        width: 200px;
        display: flex;
        justify-content: start;
        padding: 8px;
    }

    .button-create-item {
        width: 100%;
        height: 30px;
    }
</style>
