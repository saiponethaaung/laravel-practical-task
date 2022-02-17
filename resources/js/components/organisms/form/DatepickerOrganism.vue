<template>
    <div>
        <b-form-group>
            <b-form-group
                :id="'string-' + form.content.id"
                :label="form.content.name"
                :label-for="'string-form-' + form.content.id"
            >
                <b-form-datepicker
                    v-model="form.answer"
                    :id="'string-form-' + form.content.id"
                    type="text"
                    placeholder=""
                    :disabled="loading"
                    :min="form.content.min"
                    :max="form.content.max"
                    required
                ></b-form-datepicker>
            </b-form-group>
        </b-form-group>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class DatepickerOrganism extends Vue {
    @Prop()
    loading: any;

    @Prop()
    form: any;
}
</script>
