<template>
    <div class="event-page" v-if="!!data" :style="{'--theme-color': data.settings.color}"
         :class="{'light': data.settings.light_theme}">
        <!--TODO: remove this button later-->
        <div class="event-background" :style="{'backgroundImage': 'url(' + data.image + ')'}"></div>
        <div class="event-content flex-grid">
            <div class="event-content-row flex-grid column-desktop-12 column-tablet-12 column-mobile-12">
                <div class="event-titlebar column-desktop-12 column-tablet-12 column-mobile-12">
                    <div class="flex-grid">
                        <div class="event-titlebar-part-holder column-desktop-4 column-tablet-12 column-mobile-12 title-holder">
                            <h1 class="event-titlebar-title" v-text="data.name"></h1>
                        </div>
                        <div class="event-titlebar-part-holder column-desktop-4 column-tablet-12 column-mobile-12 description-holder">
                            <h4 class="event-titlebar-description" v-text="data.description"></h4>
                        </div>
                        <div class="event-titlebar-part-holder part-half column-desktop-4 column-tablet-4 column-mobile-6">
                            <div class="event-titlebar-ticketcounter-holder"
                                 v-if="currentTickets >= data.settings.visible_registrations">
                                <p class="event-titlebar-ticketcounter-text">Aantal tickets verkrijgbaar</p>
                                <div class="event-titlebar-ticketcounter">
                                    <span class="event-titlebar-current-ticketcount">{{currentTickets}}/</span>
                                    <span class="event-titlebar-maximum-ticketcount">{{data.settings.max_registrations}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="event-titlebar-whitespace column-desktop-12"></div>
                        <div class="event-titlebar-part-holder part-half column-desktop-4 column-tablet-8 column-mobile-6 date-holder">
                            <span class="event-titlebar-date" v-text="formatDate(data.settings.date_start)"></span>
                        </div>
                        <div class="event-titlebar-part-holder column-desktop-4 column-tablet-12 column-mobile-12">
                            <div class="event-titlebar-line">
                                <hr class="event-titlebar-divider">
                                <p class="event-titlebar-line-text desktop-3">stel hier uw ticket samen onder</p>
                            </div>
                        </div>
                        <div class="event-titlebar-part-holder contains-btn column-desktop-4 column-tablet-12 column-mobile-12">
                            <button @click="()=>{}" class="event-titlebar-btn">Bekijk plattegrond</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="event-content-row flex-grid column-desktop-12 column-tablet-12 column-mobile-12">
                <div class="event-program_and_info column-desktop-4 column-tablet-5 column-mobile-12">
                    <div class="event-program_and_info-content">
                        <div class="event-program" v-for="program in data.program.filter((f)=> f.type === 'program')">
                            <b class="event-program-title">{{program.name}}</b>
                            <template v-for="block in program.block">
                                <div class="event-program-part" v-for="part in block.items">
                                    <div class="event-program-part-text">
                                        <b class="event-program-part-title">{{part.name}}</b>
                                        <p class="event-program-part-description">{{part.description}}</p>
                                    </div>
                                    <span class="event-program-part-time">{{getTime(part.date_start)}}</span>
                                </div>
                            </template>
                        </div>
                        <div class="event-info">
                            <hr class="event-info-divider">
                            <b class="event-info-title">Info</b>
                            <div class="event-info-line">
                                <b class="event-info-line-title">Datum</b><br>
                                <span class="event-info-line-content">
                                    {{formatDate(data.settings.date_start)}} {{getTime(data.settings.date_start)}}
                                    tot
                                    {{formatDate(data.settings.date_end)}} {{getTime(data.settings.date_end)}}
                                </span>
                            </div>
                            <div class="event-info-line">
                                <b class="event-info-line-title">Locatie</b><br>
                                <span class="event-info-line-content">{{info.location}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event-congress column-desktop-8 column-tablet-7 column-mobile-12 flex-grid">
                    <b class="event-congress-title column-desktop-12 column-tablet-12 column-mobile-12">Congress</b>
                    <p class="event-congress-description column-desktop-4 column-tablet-4 column-mobile-4">
                        Bekijk en selecteer lezingen
                        per ronde voor dit evenement.
                    </p>
                    <div class="event-congress-rounds column-desktop-12 column-tablet-12 column-mobile-12 flex-grid">
                        <div class="event-congress-round  column-desktop-4 column-tablet-12 column-mobile-12"
                             v-for="(round, index) in congress">
                            <div class="event-congress-round-content">
                                <b class="event-congress-round-title"><b>Ronde {{index+1}}</b>
                                    <span>{{round.time}}</span></b>
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
                                <b class="event-congress-round-title"><b>Keynotespreker</b>
                                    <span>{{round.speaker.time}}</span></b>
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
            </div>
            <div class="event-content-row row-reverse flex-grid column-desktop-12 column-tablet-12 column-mobile-12">
                <div class="event-my_speakers column-desktop-8 column-tablet-7 column-mobile-12 flex-grid">
                    <b class="event-my_speakers-title column-desktop-4 column-tablet-12 column-mobile-12">Geselecteerde
                        Sprekers</b>
                    <div class="event-my_speakers-rounds column-desktop-12 column-tablet-12 column-mobile-12 flex-grid">
                        <div class="event-my_speakers-round column-desktop-4 column-tablet-12 column-mobile-12"
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
                                    <div class="event-my_speakers-speaker-content">
                                        <b class="event-my_speakers-round-speaker-title">{{speaker.name}}</b>
                                        <span class="event-my_speakers-round-speaker-description">{{speaker.position}}</span>
                                    </div>
                                    <div class="event-my_speakers-round-speaker-button-holder"
                                         @click="removeSelection(index)">
                                        <button class="event-my_speakers-round-speaker-button">
                                            <div></div>
                                        </button>
                                    </div>
                                </div>
                                <div v-else class="event-my_speakers-round-speaker">
                                    <h4>Er is nog geen spreker uit gekozen voor deze ronde</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--TODO: Modal?-->
                <div class="event-modal column-desktop-4 column-tablet-5 column-mobile-12"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import API from "@/js/Api";

    export default ({
        name: 'Event',
        async mounted() {
            this.selectedSpeakers = new Array(this.congress.length);
            let response = await API.get('/api/event-overview/' + 1);
            this.data = response.data;
        },
        methods: {
            formatDate(date) {
                let datetime = new Date(date);
                return datetime.getDate() + "-" + (datetime.getMonth() + 1) + "-" + datetime.getFullYear();
            },
            getTime(dateObj) {
                let date = new Date(dateObj);
                let hours = date.getHours().toString();
                let minutes = date.getMinutes().toString();
                if (hours.length === 1) {
                    hours = "0" + hours
                }
                if (minutes.length === 1) {
                    minutes = "0" + minutes
                }
                return hours + ":" + minutes;
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
                data: null,
                selectedSpeakers: [],
                currentTickets: 135,
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
