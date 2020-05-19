<template>
    <div class="homepage-full">
        <div class="flex-wrapper">
            <h1>Evenementen</h1>
        </div>

        <div class="flex-wrapper homepage-inner">
            <div class="home-events flex-grid">
                <div v-for="item in items" class="home-event-outer column-desktop-4 column-tablet-6 column-mobile-12">
                    <div class="home-event" @click="$router.push('event')">
                        <div class="home-event-background" :style="{backgroundColor: item.color, backgroundImage: 'url(' + item.image + ')'}">
                            <!--TODO: Image Background-->
                        </div>
                        <div class="home-event-content">
                            <h2>{{item.title}}</h2>
                            <hr class="home-divider" :style="{borderColor: item.color}">
                            <p class="home-description">
                                {{item.description}}
                            </p>
                            <hr class="home-divider-2">
                            <div class="home-event-details">
                                <div class="flex-grid">
                                    <p class="home-date column-desktop-6 column-tablet-6 column-mobile-12">
                                        {{formatDate(item.date)}}</p>
                                    <p class="home-location column-desktop-6 column-tablet-6 column-mobile-12">
                                        {{item.location}}</p>
                                </div>
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
        data() {
            return {
                items: [
                    {
                        title: 'TIDES Europe',
                        color: '#E6A65C',
                        image: 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80',
                        description:
                            'Tides offers the science,\n' +
                            'technologies and partners you\n' +
                            'need to grow your business',
                        date: '17 november 2018',
                        location: 'Alkmaar'
                    },
                    {
                        title: 'METS Trade',
                        color: '#5CE6B1',
                        image: 'https://images.unsplash.com/photo-1533911675945-49efa7c5beae?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1334&q=80',
                        description:
                            'Kickstart Europe is een strategie & netwerk\n' +
                            'conferentie aan de start van het jaar, voor\n' +
                            'C-level in data center, connectivity en\n' +
                            'cloud professionals.',
                        date: '3 december 2019',
                        location: 'Alkmaar'
                    },
                    {
                        title: 'Home delivery europe',
                        color: '#5CB6E6',
                        image: 'https://images.unsplash.com/photo-1544944399-af27c461e488?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80',
                        description:
                            'Home Delivery World Europe 2020 is the\n' +
                            'industry’s best retail logistics event,\n' +
                            'covering Parcel, Heavy Goods, Data &\n' +
                            'Analytics, Grocery, Urban Logistic',
                        date: '4 januari 2020',
                        location: 'Alkmaar'
                    }],
            }
        },
        methods: {
            formatDate(date) {
                let datetime = new Date(date);
                let formatted_date = datetime.getDate() + "-" + (datetime.getMonth() + 1) + "-" + datetime.getFullYear()
                return formatted_date
            }
        }
    });
</script>
