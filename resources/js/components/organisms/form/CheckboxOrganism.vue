<template>
    <div>
        <b-form-group
            :id="'string-' + form.content.id"
            :label="form.content.name"
            :label-for="'string-form-' + form.content.id"
        >
            <b-form-checkbox-group
                :name="'checkbox' + form.content.id"
                v-model="form.answer"
                :options="options"
                :id="'radio' + form.content.id"
                :disabled="loading"
            ></b-form-checkbox-group>
        </b-form-group>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class CheckboxOrganism extends Vue {
    @Prop()
    loading: any;

    @Prop()
    form: any;

    get options() {
        let res: any = [];

        this.form.content.options.map((o: any) => {
            res.push({
                text: o.value,
                value: o.key,
            });
        });

        return res;
    }
}
</script>
