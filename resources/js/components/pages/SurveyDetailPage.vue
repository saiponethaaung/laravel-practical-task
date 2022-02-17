<template>
    <div>
        <b-container>
            <template v-if="loading">
                <b-spinner />
            </template>
            <template v-else>
                <b-card>
                    <b-form @submit.prevent="submitForm">
                        <h5>{{ name }}</h5>
                        <br />
                        <template v-for="(f, i) in form">
                            <div :key="i">
                                <b-card>
                                    <template
                                        v-if="f.content.type === 'string'"
                                    >
                                        <StringOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <template
                                        v-else-if="f.content.type === 'text'"
                                    >
                                        <TextOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <template
                                        v-else-if="
                                            f.content.type === 'datepicker'
                                        "
                                    >
                                        <DatepickerOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <template
                                        v-else-if="f.content.type === 'radio'"
                                    >
                                        <RadioOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <template
                                        v-else-if="
                                            f.content.type === 'dropdown'
                                        "
                                    >
                                        <DropdownOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <template
                                        v-else-if="
                                            f.content.type === 'checkbox'
                                        "
                                    >
                                        <CheckboxOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <template
                                        v-else-if="f.content.type === 'range'"
                                    >
                                        <RangeOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <template
                                        v-else-if="f.content.type === 'file'"
                                    >
                                        <FileOrganism
                                            :loading="submiting"
                                            :form="f"
                                        />
                                    </template>
                                    <br />
                                    Type: {{ f.content.type }}<br />
                                    Value:{{ f.answer }}
                                </b-card>
                                <br />
                            </div>
                        </template>
                        <b-button
                            type="submit"
                            :disabled="submiting"
                            variant="primary"
                            >Sumbit</b-button
                        >
                    </b-form>
                </b-card>
            </template>
        </b-container>
    </div>
</template>

<script lang="ts">
import axios from "axios";
import { Component, Vue } from "vue-property-decorator";
import StringOrganism from "../organisms/form/StringOrganism.vue";
import DatepickerOrganism from "../organisms/form/DatepickerOrganism.vue";
import TextOrganism from "../organisms/form/TextOrganism.vue";
import RadioOrganism from "../organisms/form/RadioOrganism.vue";
import DropdownOrganism from "../organisms/form/DropdownOrganism.vue";
import CheckboxOrganism from "../organisms/form/CheckboxOrganism.vue";
import RangeOrganism from "../organisms/form/RangeOrganism.vue";
import FileOrganism from "../organisms/form/FileOrganism.vue";

@Component({
    components: {
        StringOrganism,
        TextOrganism,
        DatepickerOrganism,
        RadioOrganism,
        DropdownOrganism,
        CheckboxOrganism,
        RangeOrganism,
        FileOrganism,
    },
})
export default class SurveyDetailPage extends Vue {
    private loading = false;
    private submiting = false;

    private name = "";
    private form: any = [];

    mounted() {
        this.loadSurveyInfo();
    }

    async submitForm() {
        this.submiting = true;

        let data = new FormData();

        for (let i = 0; i < this.form.length; i++) {
            data.append(`forms[${i}][survey_form_id]`, this.form[i].content.id);
            data.append(`forms[${i}][answer]`, this.form[i].answer);
        }

        await axios({
            url: `/api/v1.0/survey/${this.$route.params.surveyID}/answer`,
            method: "post",
            data: data,
        })
            .then(() => {
                this.$router.push({ name: "home" });
            })
            .catch((err) => {
                alert(err.response.data.msg || "Failed to submit survey!");
                this.submiting = false;
            });
    }

    async loadSurveyInfo() {
        this.loading = true;

        await axios({
            url: `/api/v1.0/survey/${this.$route.params.surveyID}`,
        })
            .then((res) => {
                this.name = res.data.data.info.name;
                res.data.data.info.forms.forEach((f: any) => {
                    this.form.push({
                        content: f,
                        // answer: f.type === "checkbox" ? [] : "",
                        answer: "",
                    });
                });
            })
            .catch((err) => {
                alert(err.response.data.msg || "Failed to load survey!");
            });

        this.loading = false;
    }
}
</script>
