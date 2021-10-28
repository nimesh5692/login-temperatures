<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div>
                    <div class="h3" style="color: green; font-weight: bold">
                        Login Temperatures
                    </div>

                    <hr />

                    <div class="row">
                        <div class="offset-8 col-sm-2">
                            <button
                                class="btn btn-sm btn-block rounded-0"
                                style="background-color: hotpink"
                            >
                                Hottest First
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <button
                                class="btn btn-sm btn-block rounded-0"
                                style="background-color: violet"
                                @click="resetOrder()"
                            >
                                Reset Order
                            </button>
                        </div>
                    </div>

                    <br />

                    <div class="row">
                        <div
                            class="col-sm-6"
                            v-for="(city, city_index) in cities"
                            :key="city_index"
                        >
                            <h3 style="font-weight: bold">{{ city.name }}</h3>
                            <br />
                            <div
                                v-for="(row, meta_index) in userMetaData"
                                :key="meta_index"
                            >
                                <p v-if="row.city == city_index">
                                    {{ row.created_at }} &nbsp;
                                    {{ row.celsius_temp }}&#8451; /
                                    {{ row.fahrenheit_temp }}&#8457;
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            cities: [],
            userMetaData: [],
        };
    },
    methods: {
        fetchData() {
            axios
                .get(`/home`)
                .then((response) => {
                    this.cities = response.data.cities;
                    this.userMetaData = response.data.userMetaData;
                    console.log(response.data);
                })
                .catch((e) => {
                    console.log(e);
                });
        },
        reset() {
            this.cities = [];
            this.userMetaData = [];
        },
        hottestFirst() {
            this.userMetaData = this.userMetaData.sort();
        },
        resetOrder() {
            this.reset();
            this.fetchData();
        },
    },
    mounted() {
        this.fetchData();
    },
};
</script>
