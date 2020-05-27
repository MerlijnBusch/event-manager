<template>
    <div class="event-page" :style="{'--theme-color': color}">
        <div class="event-background" :style="{'backgroundImage': 'url(' + backgroundImage + ')'}"></div>
        <div class="event-content flex-grid">
            <div class="event-titlebar column-desktop-12 column-tablet-12 column-mobile-12">
                <div class="flex-grid">
                    <div class="event-titlebar-part-holder column-desktop-4">
                        <h1 class="event-titlebar-title" v-text="title"></h1>
                    </div>
                    <div class="event-titlebar-part-holder column-desktop-4">
                        <h4 class="event-titlebar-description" v-text="description"></h4>
                    </div>
                    <div class="event-titlebar-part-holder column-desktop-4">
                        <div class="event-titlebar-ticketcounter" v-if="tickets.isShowing">
                            <span class="event-titlebar-current-ticketcount">{{tickets.current}}/</span>
                            <span class="event-titlebar-maximum-ticketcount">{{tickets.max}}</span>
                        </div>
                    </div>
                    <div class="event-titlebar-whitespace column-desktop-12"></div>
                    <div class="event-titlebar-part-holder column-desktop-4">
                        <span class="event-titlebar-date" v-text="formatDate(info.date)"></span>
                    </div>
                    <div class="event-titlebar-part-holder column-desktop-4">
                        <div class="event-titlebar-line">
                            <hr class="event-titlebar-divider">
                            <p class="event-titlebar-line-text desktop-3">stel hier uw ticket samen onder</p>
                        </div>
                    </div>
                    <div class="event-titlebar-part-holder contains-btn column-desktop-4">
                        <button @click="()=>{}" class="event-titlebar-btn">Bekijk plattegrond</button>
                    </div>
                </div>
            </div>
            <div class="event-program_and_info column-desktop-4 column-tablet-6 column-mobile-12">
                <div class="event-program_and_info-content">
                    <div class="event-program">
                        <b class="event-program-title">Programma</b>
                        <div class="event-program-part" v-for="part in program">
                            <div class="event-program-part-text">
                                <b class="event-program-part-title">{{part.title}}</b>
                                <p class="event-program-part-description">{{part.description}}</p>
                            </div>
                            <span class="event-program-part-time">{{part.time}}</span>
                        </div>
                    </div>
                    <div class="event-info">
                        <hr class="event-info-divider">
                        <b class="event-info-title">Info</b>
                        <div class="event-info-line">
                            <b class="event-info-line-title">Datum</b><br>
                            <span class="event-info-line-content">{{formatDate(info.date)}}</span>
                        </div>
                        <div class="event-info-line">
                            <b class="event-info-line-title">Locatie</b><br>
                            <span class="event-info-line-content">{{info.location}}</span>
                        </div>
                        <div class="event-info-line">
                            <b class="event-info-line-title">Prijs</b><br>
                            <span class="event-info-line-content">{{info.price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="event-congress column-desktop-8 column-tablet-6 column-mobile-12 flex-grid">
                <b class="event-congress-title column-desktop-12 column-tablet-12 column-mobile-12">Congress</b>
                <p class="event-congress-description column-desktop-4 column-tablet-4 column-mobile-4">
                    Bekijk en selecteer lezingen
                    per ronde voor dit evenement.
                </p>
                <div class="event-congress-rounds column-desktop-12 column-tablet-12 column-mobile-12 flex-grid">
                    <div class="event-congress-round  column-desktop-4 column-tablet-12 column-mobile-12"
                         v-for="(round, index) in congress">
                        <div class="event-congress-round-content">
                            <b class="event-congress-round-title">Ronde {{index+1}} <span>{{round.time}}</span></b>
                            <div class="event-congress-round-speakers">
                                <div class="event-congress-round-speaker" v-for="speaker in round.speakers">
                                    <div class="event-congress-round-speaker-content">
                                        <b class="event-congress-round-speaker-title">{{speaker.name}}</b>
                                        <span class="event-congress-round-speaker-position">{{speaker.position}}</span>
                                    </div>
                                    <div class="event-congress-round-checkbox-holder">
                                        <button class="event-congress-round-speaker-checkbox"
                                                :class="{'active' : selectedSpeakers.length && !!selectedSpeakers[index] && selectedSpeakers[index].id === speaker.id}"
                                                @click="setSpeaker(index, speaker, round.time)">
                                            <div></div>
                                            <div></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <b class="event-congress-round-title">Keynotespreker <span>{{round.speaker.time}}</span></b>
                            <div class="event-congress-round-keynote">
                                <div class="event-congress-round-speaker-content">
                                    <b class="event-congress-round-speaker-title">{{round.speaker.name}}</b>
                                    <span class="event-congress-round-speaker-position">{{round.speaker.position}}</span>
                                </div>
                                <div class="event-congress-round-checkbox-holder">
                                    <button class="event-congress-round-speaker-checkbox"
                                            :class="{'active' : selectedSpeakers.length && !!selectedSpeakers[index] && selectedSpeakers[index].id === round.speaker.id}"
                                            @click="setSpeaker(index, round.speaker, round.speaker.time, true)">
                                        <div></div>
                                        <div></div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--TODO: Modal?-->
            <div class="event-modal column-desktop-4 column-tablet-4 column-mobile-12"></div>
            <div class="event-my_speakers column-desktop-8 column-tablet-8 column-mobile-12 flex-grid">
                <b class="event-my_speakers-title column-desktop-4 column-tablet-6 column-mobile-12">Geselecteerde
                    Sprekers</b>
                <div class="event-my_speakers-rounds column-desktop-12 column-tablet-12 column-mobile-12 flex-grid">
                    <div class="event-my_speakers-round column-desktop-4 column-tablet-4 column-mobile-12"
                         v-for="(speaker,index) in selectedSpeakers">
                        <div class="event-my_speaker-round-content">
                            <b class="event-my_speakers-round-title">Ronde
                                {{index + 1}}
                                <span class="event-my_speakers-round-title-time"
                                      v-if="!!speaker">{{speaker.time}}</span>
                                <b class="event-my_speakers-round-title-keynote"
                                   v-if="!!speaker && speaker.isKeynote">Keynotespreker</b>
                            </b>

                            <div class="event-my_speakers-round-speaker" v-if="!!speaker">
                                <b class="event-my_speakers-round-speaker-title">{{speaker.name}}</b>
                                <span class="event-my_speakers-round-speaker-description">{{speaker.description}}</span>
                                <button class="event-my_speakers-round-speaker-close-button"
                                        @click="removeSelection(index)">
                                    <!--TODO: Remove X later-->
                                    X
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default ({
        name: 'Event',
        mounted() {
            this.selectedSpeakers = new Array(this.congress.length);
        },
        methods: {
            formatDate(date) {
                let datetime = new Date(date);
                return datetime.getDate() + "-" + (datetime.getMonth() + 1) + "-" + datetime.getFullYear();
            },
            setSpeaker(index, speaker, time, isKeynote = false) {
                let selectedSpeakers = this.selectedSpeakers;
                speaker = JSON.parse(JSON.stringify(speaker));
                speaker.isKeynote = isKeynote;
                speaker.time = time;
                selectedSpeakers[index] = speaker;
                this.selectedSpeakers = selectedSpeakers;
                this.$forceUpdate();
            },
            removeSelection(index) {
                this.selectedSpeakers[index] = null;
                this.$forceUpdate();
            }
        },
        data() {
            return {
                selectedSpeakers: [],
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
                                name: 'Merijn Everaarts',
                                id: 1,
                                position: 'CEO Dopper',
                            },
                            {
                                name: 'Eva Janssen',
                                id: 2,
                                position: 'Market analyst',
                            },
                            {
                                name: 'Merijn Everaarts',
                                id: 3,
                                position: 'CEO Dopper',
                            },
                            {
                                name: 'Eva Janssen',
                                id: 4,
                                position: 'Market analyst',
                            }
                        ],
                        speaker: {
                            time: '11:00 - 12:00',
                            name: 'Syp Arends',
                            id: 5,
                            position: 'CEO Pyroil',
                        },
                    },
                    {
                        time: '13:00 - 14:00',
                        speakers: [
                            {
                                name: 'Merijn Everaarts',
                                id: 1,
                                position: 'CEO Dopper',
                            },
                            {
                                name: 'Eva Janssen',
                                id: 2,
                                position: 'Market analyst',
                            },
                            {
                                name: 'Merijn Everaarts',
                                id: 3,
                                position: 'CEO Dopper',
                            },
                            {
                                name: 'Eva Janssen',
                                id: 4,
                                position: 'Market analyst',
                            }
                        ],
                        speaker: {
                            time: '14:00 - 15:00',
                            name: 'Syp Arends',
                            id: 5,
                            position: 'CEO Pyroil',
                        },
                    },
                    {
                        time: '15:30 - 16:30',
                        speakers: [
                            {
                                name: 'Merijn Everaarts',
                                id: 1,
                                position: 'CEO Dopper',
                            },
                            {
                                name: 'Eva Janssen',
                                id: 2,
                                position: 'Market analyst',
                            },
                            {
                                name: 'Merijn Everaarts',
                                id: 3,
                                position: 'CEO Dopper',
                            },
                            {
                                name: 'Eva Janssen',
                                id: 4,
                                position: 'Market analyst',
                            }
                        ],
                        speaker: {
                            time: '14:00 - 15:00',
                            name: 'Syp Arends',
                            id: 5,
                            position: 'CEO Pyroil',
                        },
                    },
                ]
            }
        }
    });
</script>
