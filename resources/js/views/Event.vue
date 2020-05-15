<template>
    <div class="event-page">
        <div class="bg" :style="{'backgroundImage': 'url(' + backgroundImage + ')'}"></div>
        <div class="titlebar">
            <h1 class="title" v-text="title"></h1>
            <h4 class="description" v-text="description"></h4>
            <span class="date" v-text="formatDate(info.date)"></span>
            <div class="ticketview" v-if="tickets.isShowing">
                <span>{{tickets.current}}/</span>
                <span>{{tickets.max}}/</span>
            </div>
        </div>
        <div class="program-info-bla">
            <div class="program">
                <b>Programma</b>
                <div v-for="part in program">
                    <b class="title">{{part.title}}</b>
                    <p class="description">{{part.description}}</p>
                    <span class="date">{{part.time}}</span>
                </div>
            </div>
            <div class="info">
                <b>Info</b>
                <div>
                    <b>Datum</b>
                    <span>{{formatDate(info.date)}}</span>
                </div>
                <div>
                    <b>Locatie</b>
                    <span>{{info.location}}</span>
                </div>
                <div>
                    <b>Prijs</b>
                    <span>{{info.price}}</span>
                </div>
            </div>
        </div>
        <div class="congress">
            <b class="title">Congress</b>
            <p class="description">
                Bekijk en selecteer lezingen
                per ronde voor dit evenement.
            </p>
            <div class="rounds">
                <div class="round" v-for="(round, index) in congress">
                    <b>Ronde {{index+1}} <span>{{round.time}}</span></b>
                    <div class="speakers">
                        <div v-for="speaker in round.speakers">
                            <b>{{speaker.name}}</b>
                            <span>{{speaker.position}}</span>
                            <input type="checkbox" @change="deselectSpeakers(index, speaker)" v-model="speaker.selected">
                        </div>
                    </div>
                    <b>Keynotespreker <span>{{round.speaker.time}}</span></b>
                    <div class="keynote-bla">
                        <b>{{round.speaker.name}}</b>
                        <span>{{round.speaker.position}}</span>
                        <input type="checkbox" @change="deselectSpeakers(index, round.speaker)" v-model="round.speaker.selected">
                    </div>
                </div>
            </div>
        </div>
        <div class="selected-speakers">
            <b>Geselecteerde Sprekers</b>
            <div v-for="(round,index) in congress" style="background: #eee">
                <b>Ronde {{index + 1}} <span>{{round.time}}</span></b>
                <div v-if="round.speaker.selected">
                    <b>{{round.speaker.name}}</b>
                    <span>{{round.speaker.description}}</span>
                    <button @click="round.speaker.selected = false">X</button>
                </div>
                <div v-for="speaker in round.speakers" v-if="speaker.selected">
                    <b>{{speaker.name}}</b>
                    <span>{{speaker.description}}</span>
                    <button @click="speaker.selected = false">X</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default ({
        name: 'Event',
        methods: {
            formatDate(date) {
                let datetime = new Date(date);
                return datetime.getDate() + "-" + (datetime.getMonth() + 1) + "-" + datetime.getFullYear();
            },
            deselectSpeakers(index, speaker){
                for (let i = 0; i < this.congress[index].speakers.length; i++){
                    this.congress[index].speakers[i].selected = false;
                }
                this.congress[index].speaker.selected = false;
                console.log(speaker);
                speaker.selected = true;
                // this.$forceUpdate();
            },
        },
        data() {
            return {
                title: 'Tides Europe',
                backgroundImage: 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80',
                color: '#E6A65C',
                description: 'Tides offers the science,\n' +
                    'technologies and partners you \n' +
                    'need to grow your business',
                tickets: {
                    current: 98,
                    max: 110,
                    isShowing: true,
                },
                program: [
                    {
                        title: 'Opening',
                        description: 'Voor ondernemers en werkzoekende',
                        time: '11:00-12:00'
                    },
                    {
                        title: 'Officele Opening',
                        description: 'Door Edward Stigter',
                        time: '12:30-13:00'
                    },
                    {
                        title: 'Speeddates',
                        description: 'Voor studenten',
                        time: '13:00-13:30'
                    },
                    {
                        title: 'Finale',
                        description: 'Prijsuitrijking',
                        time: '13:30-14:00'
                    }
                ],
                info: {
                    date: '17 november 2018',
                    location: 'Alkmaar entrance B',
                    price: '45 - 180 EUR'
                },
                congress: [
                    {
                        time: '9:00 - 10:00',
                        speakers: [
                            {
                                selected: false,
                                name: 'Merijn Everaarts',
                                position: 'CEO Dopper',
                            },
                            {
                                selected: false,
                                name: 'Eva Janssen',
                                position: 'Market analyst',
                            },
                            {
                                selected: false,
                                name: 'Merijn Everaarts',
                                position: 'CEO Dopper',
                            },
                            {
                                selected: false,
                                name: 'Eva Janssen',
                                position: 'Market analyst',
                            }
                        ],
                        speaker: {
                            selected: false,
                            time: '11:00 - 12:00',
                            name: 'Syp Arends',
                            position: 'CEO Pyroil',
                        },
                    },
                    {
                        time: '13:00 - 14:00',
                        speakers: [
                            {
                                selected: false,
                                name: 'Merijn Everaarts',
                                position: 'CEO Dopper',
                            },
                            {
                                selected: false,
                                name: 'Eva Janssen',
                                position: 'Market analyst',
                            },
                            {
                                selected: false,
                                name: 'Merijn Everaarts',
                                position: 'CEO Dopper',
                            },
                            {
                                selected: false,
                                name: 'Eva Janssen',
                                position: 'Market analyst',
                            }
                        ],
                        speaker: {
                            selected: false,
                            time: '14:00 - 15:00',
                            name: 'Syp Arends',
                            position: 'CEO Pyroil',
                        },
                    },
                    {
                        time: '15:30 - 16:30',
                        speakers: [
                            {
                                selected: false,
                                name: 'Merijn Everaarts',
                                position: 'CEO Dopper',
                            },
                            {
                                selected: false,
                                name: 'Eva Janssen',
                                position: 'Market analyst',
                            },
                            {
                                selected: false,
                                name: 'Merijn Everaarts',
                                position: 'CEO Dopper',
                            },
                            {
                                selected: false,
                                name: 'Eva Janssen',
                                position: 'Market analyst',
                            }
                        ],
                        speaker: {
                            selected: false,
                            time: '14:00 - 15:00',
                            name: 'Syp Arends',
                            position: 'CEOlPyroil',
                        },
                    },
                ]
            }
        }
    });
</script>