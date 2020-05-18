<template>
    <div class="event-page">
        <div class="event-background" :style="{'backgroundImage': 'url(' + backgroundImage + ')'}"></div>
        <div class="event-content flex-grid">
            <div class="event-titlebar column-desktop-12 column-tablet-12 column-mobile-12 flex-grid">
                <h1 class="event-titlebar-title column-desktop-3" v-text="title"></h1>
                <h4 class="event-titlebar-descript column-desktop-3" v-text="description"></h4>
                <span class="event-titlebar-date" v-text="formatDate(info.date)"></span>
                <div class="event-titlebar-ticketcounter column-desktop-3" v-if="tickets.isShowing">
                    <span class="event-titlebar-current-ticketcount">{{tickets.current}}/</span>
                    <span class="event-titlebar-maximum-ticketcount">{{tickets.max}}</span>
                </div>
            </div>
            <div class="event-program_and_info column-desktop-4 column-tablet-6 column-mobile-12">
                <div class="event-program">
                    <b class="event-program-title">Programma</b>
                    <div class="event-program-part" v-for="part in program">
                        <b class="event-program-part-title">{{part.title}}</b>
                        <p class="event-program-part-description">{{part.description}}</p>
                        <span class="event-program-part-time">{{part.time}}</span>
                    </div>
                </div>
                <div class="event-info">
                    <b class="event-info-title">Info</b>
                    <div class="event-info-line">
                        <b class="event-info-line-title">Datum</b>
                        <span class="event-info-line-content">{{formatDate(info.date)}}</span>
                    </div>
                    <div class="event-info-line">
                        <b class="event-info-line-title">Locatie</b>
                        <span class="event-info-line-content">{{info.location}}</span>
                    </div>
                    <div class="event-info-line">
                        <b class="event-info-line-title">Prijs</b>
                        <span class="event-info-line-content">{{info.price}}</span>
                    </div>
                </div>
            </div>
            <div class="event-congress column-desktop-8 column-tablet-6 column-mobile-12">
                <b class="event-congress-title">Congress</b>
                <p class="event-congress-description">
                    Bekijk en selecteer lezingen
                    per ronde voor dit evenement.
                </p>
                <div class="event-congress-rounds">
                    <div class="event-congress-round" v-for="(round, index) in congress">
                        <b class="event-congress-round-title">Ronde {{index+1}} <span>{{round.time}}</span></b>
                        <div class="event-congress-round-speakers">
                            <div class="event-congress-round-speaker" v-for="speaker in round.speakers">
                                <b class="event-congress-round-speaker-title">{{speaker.name}}</b>
                                <span class="event-congress-round-speaker-position">{{speaker.position}}</span>
                                <input class="event-congress-round-speaker-checkbox" type="checkbox"
                                       @change="deselectSpeakers(index, speaker)"
                                       v-model="speaker.selected">
                            </div>
                        </div>
                        <b>Keynotespreker <span>{{round.speaker.time}}</span></b>
                        <div class="event-congress-round-keynote">
                            <b class="event-congress-round-keynote-title">{{round.speaker.name}}</b>
                            <span class="event-congress-round-keynote-position">{{round.speaker.position}}</span>
                            <input class="event-congress-round-keynote-checkbox" type="checkbox"
                                   @change="deselectSpeakers(index, round.speaker)"
                                   v-model="round.speaker.selected">
                        </div>
                    </div>
                </div>
            </div>
            <div class="event-my_speakers column-desktop-12 column-tablet-12 column-mobile-12">
                <b class="event-my_speakers-title">Geselecteerde Sprekers</b>
                <div class="event-my_speakers-round" v-for="(round,index) in congress">
                    <b class="event-my_speakers-round-title">Ronde {{index + 1}}
                        <span class="event-my_speakers-round-title-time">{{round.time}}</span>
                        <span class="event-my_speakers-round-title-keynote"
                              v-if="round.speaker.selected">Keynotespreker</span>
                    </b>
                    <div class="event-my_speakers-round-speaker" v-if="round.speaker.selected">
                        <b class="event-my_speakers-round-speaker-title">{{round.speaker.name}}</b>
                        <span class="event-my_speakers-round-speaker-description">{{round.speaker.description}}</span>
                        <button class="event-my_speakers-round-speaker-close-button"
                                @click="round.speaker.selected = false">
                            <!--TODO: Remove X later-->
                            X
                        </button>
                    </div>
                    <div v-else v-for="speaker in round.speakers" v-if="speaker.selected">
                        <b class="event-my_speakers-round-speaker-title">{{speaker.name}}</b>
                        <span class="event-my_speakers-round-speaker-description">{{speaker.description}}</span>
                        <button class="event-my_speakers-round-speaker-close-button"
                                @click="speaker.selected = false">
                            <!--TODO: Remove X later-->
                            X
                        </button>
                    </div>
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
            deselectSpeakers(index, speaker) {
                for (let i = 0; i < this.congress[index].speakers.length; i++) {
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
