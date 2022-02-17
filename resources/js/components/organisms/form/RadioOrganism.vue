<template>
    <div>
        <b-form-group
            :id="'string-' + form.content.id"
            :label="form.content.name"
            :label-for="'string-form-' + form.content.id"
        >
            <template v-for="(r, i) in form.content.options">
                <b-form-radio
                    :key="'radio' + form.content.id + '-' + i"
                    v-model="form.answer"
                    :name="'radio' + form.content.id + '-' + i"
                    :value="r.key"
                    :disabled="loading"
                    >{{ r.value }}</b-form-radio
                >
            </template>
        </b-form-group>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class RadioOrganism extends Vue {
    @Prop()
    loading: any;

    @Prop()
    form: any;
}
</script>
