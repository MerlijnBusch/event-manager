<template>
  <div class="homepage-full">
    <div class="flex-wrapper">
      <h1>Evenementen</h1>
    </div>

    <div class="flex-wrapper homepage-inner">
      <div class="home-events flex-grid">
        <div
          v-for="item in [...data,...data,...data,...data,...data,...data]"
          :key="item.id"
          class="home-event-outer column-desktop-4 column-tablet-6 column-mobile-12"
        >
          <div
            class="home-event"
            @click="$router.push('event/' + item.id)"
          >
            <div
              class="home-event-background"
              :style="{backgroundColor: item.settings.color, backgroundImage: 'url(' + item.image + ')'}"
            />
            <div class="home-event-content">
              <h2>{{ item.name }}</h2>
              <hr
                class="home-divider"
                :style="{borderColor: item.settings.color}"
              >
              <p class="home-description">
                {{ item.description }}
              </p>
              <hr class="home-divider-2">
              <div class="home-event-details">
                <div class="flex-grid">
                  <p class="home-date column-desktop-6 column-tablet-6 column-mobile-12">
                    {{ formatDate(item.settings.date_start) }}
                  </p>
                  <p class="home-location column-desktop-6 column-tablet-6 column-mobile-12">
                    <!--{{item.location}}-->
                    LOCATION HERE <!--TODO:-->
                  </p>
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
import API from '@/js/Api';

export default ({
    async mounted () {
        const response = await API.get('/api/event-overview');
        this.data = response.data;
        console.log(JSON.parse(JSON.stringify(response.data)));
    },
    data () {
        return {
            data: []
        };
    },
    methods: {
        formatDate (date) {
            const datetime = new Date(date);
            const formattedDate = datetime.getDate() + '-' + (datetime.getMonth() + 1) + '-' + datetime.getFullYear();
            return formattedDate;
        }
    }
});
</script>
