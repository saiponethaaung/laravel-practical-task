<template>
    <div>
        <b-container>
            <b-card title="Create Survey">
                <b-form @submit.prevent="createSurvey">
                    <b-form-group>
                        <b-form-group
                            id="input-group-1"
                            label="Name:"
                            label-for="input-1"
                        >
                            <b-form-input
                                id="input-1"
                                v-model="survey.name"
                                type="text"
                                placeholder="Enter survey name"
                                required
                                :disabled="loading"
                            ></b-form-input>
                        </b-form-group>
                        <br />
                    </b-form-group>
                    <template v-for="(form, index) in survey.forms">
                        <CreateSurveyFormOrganism
                            :key="index"
                            :form="form"
                            :index="index"
                            :loading="loading"
                            @deleteForm="deleteForm(index)"
                        />
                    </template>
                    <br />
                    <b-button @click="addForm" size="sm" :disabled="loading">
                        Add new form
                    </b-button>
                    <br />
                    <br />
                    <b-button
                        type="submit"
                        :disabled="loading"
                        variant="primary"
                        >Create</b-button
                    >
                </b-form>
            </b-card>
        </b-container>
    </div>
</template>

<script lang="ts">
import axios from "axios";
import { Component, Vue } from "vue-property-decorator";
import CreateSurveyFormOrganism from "../organisms/CreateSurveyFormOrganism.vue";

@Component({
    components: {
        CreateSurveyFormOrganism,
    },
})
export default class CreateSurveyPage extends Vue {
    private loading = false;

    private survey: any = {
        name: "",
        forms: [],
    };

    addForm() {
        this.survey.forms.push({
            name: "",
            type: "string",
            min: "",
            max: "",
            values: "",
            max_size: -1,
            char_count: -1,
            options: [],
            optional: false,
            multiple: false,
        });
    }

    async createSurvey() {
        this.loading = true;

        await axios({
            url: "/api/v1.0/survey",
            method: "post",
            data: {
                info: {
                    name: this.survey.name,
                },
                forms: this.survey.forms,
            },
        })
            .then(() => {
                this.$router.push({ name: "home" });
            })
            .catch((err) => {
                alert(err.response.data.msg || "Failed to create survey form!");
                this.loading = false;
            });
    }

    deleteForm(index: number) {
        this.survey.forms.splice(index, 1);
    }
}
</script>
