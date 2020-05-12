<template>
    <div class="homepage-full">
        <h1>Evenementen</h1>

        <div class="flex-wrapper">
            <div class="home-events flex-grid">
                <div v-for="item in items" class="home-event column-desktop-4 column-tablet-12 column-mobile-12">
                    <div class="home-event-background"></div>
                    <h2>{{item.title}}</h2>
                    <hr class="home-divider">
                    <p class="home-description">
                        {{item.description}}
                    </p>
                    <hr class="home-divider-2">
                    <div class="flex-wrapper">
                        <div class="flex-grid">
                            <p class="home-date column-desktop-6">{{formatDate(item.date)}}</p>
                            <p class="home-location column-desktop-6">{{item.location}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default ({
        data(){
            return{
                items: [
                    {
                        title: 'TIDES Europe',
                        description:
                            'Tides offers the science,\n' +
                            'technologies and partners you\n' +
                            'need to grow your business',
                        date: new Date(),
                        location: 'Amsterdam'
                    },
                    {
                        title: 'TIDES Europe',
                        description:
                            'Tides offers the science,\n' +
                            'technologies and partners you\n' +
                            'need to grow your business',
                        date: new Date(),
                        location: 'Amsterdam'
                    },
                    {
                        title: 'TIDES Europe',
                        description:
                            'Tides offers the science,\n' +
                            'technologies and partners you\n' +
                            'need to grow your business',
                        date: new Date(),
                        location: 'Amsterdam'
                    }],
            }
        },
        methods:{
            formatDate(date){
                let datetime = new Date(date);
                let formatted_date = datetime.getDate() + "-" + (datetime.getMonth() + 1) + "-" + datetime.getFullYear()
                return formatted_date
            }
        }
    });
</script>
