<template>
    <div class="homepage-full">
        <h1>Evenementen</h1>

        <div class="flex-wrapper">
            <div class="home-events flex-grid">
                <div v-for="item in items" class="home-event column-desktop-4 column-tablet-6 column-mobile-12">
                    <div class="home-event-background" :style="{backgroundColor: item.color}">
                        <!--TODO: Image Background-->
                    </div>
                    <div class="home-event-content">
                        <h2>{{item.title}}</h2>
                        <hr class="home-divider" :style="{borderColor: item.color}">
                        <p class="home-description">
                            {{item.description}}
                        </p>
                        <hr class="home-divider-2">
                        <div class="flex-wrapper">
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
</template>

<script>
    export default ({
        data() {
            return {
                items: [
                    {
                        title: 'TIDES Europe',
                        color: '#E6A65C',
                        description:
                            'Tides offers the science,\n' +
                            'technologies and partners you\n' +
                            'need to grow your business',
                        date: '17 november 2018',
                        location: 'Alkmaar, Alkmaar'
                    },
                    {
                        title: 'METS Trade',
                        color: '#5CE6B1',
                        description:
                            'Kickstart Europe is een strategie & netwerk\n' +
                            'conferentie aan de start van het jaar, voor\n' +
                            'C-level in data center, connectivity en\n' +
                            'cloud professionals.',
                        date:'3 december 2019',
                        location: 'Alkmaar, Alkmaar'
                    },
                    {
                        title: 'Home delivery\n' +
                            'europe',
                        color: '#5CB6E6',
                        description:
                            'Home Delivery World Europe 2020 is the\n' +
                            'industry’s best retail logistics event,\n' +
                            'covering Parcel, Heavy Goods, Data &\n' +
                            'Analytics, Grocery, Urban Logistic',
                        date: '4 januari 2020',
                        location: 'Alkmaar, Alkmaar'
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
