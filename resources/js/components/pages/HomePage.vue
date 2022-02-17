<template>
    <div>
        <b-container>
            <b-row align-h="between">
                <b-col>
                    <h4>Survey list</h4>
                </b-col>
                <b-col class="text-right">
                    <router-link
                        :to="{ name: 'survey.create' }"
                        class="btn btn-secondary"
                        >Create Survey</router-link
                    >
                </b-col>
            </b-row>
            <b-row class="mt15">
                <b-col sm="12">
                    <h6>
                        Showing {{ pagination.from }} - {{ pagination.to }} of
                        {{ pagination.total }}
                    </h6>
                </b-col>
                <b-col sm="12">
                    <ul>
                        <template v-for="(l, i) in list">
                            <li :key="i">
                                <router-link
                                    :to="{
                                        name: 'survey.detail',
                                        params: { surveyID: l.id },
                                    }"
                                >
                                    {{ l.id }}: {{ l.name }}
                                </router-link>
                            </li>
                        </template>
                    </ul>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script lang="ts">
import axios from "axios";
import { Component, Vue } from "vue-property-decorator";

@Component
export default class HomePage extends Vue {
    private loading = false;

    private list = {};

    private pagination = {
        from: 0,
        to: 0,
        total: 0,
        current: 0,
        last: 0,
        hasNext: false,
    };

    mounted() {
        this.loadSurveyList();
    }

    async loadSurveyList(page = 1) {
        this.loading = true;

        await axios({
            url: `/api/v1.0/survey?page=${page}`,
        })
            .then((res) => {
                this.list = res.data.data.list;
                this.pagination = res.data.data.pagination;
            })
            .catch((err) => {
                alert(err.response.data.msg || "Failed to load survey!");
            });

        this.loading = false;
    }
}
</script>
