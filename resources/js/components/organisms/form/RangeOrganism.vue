<template>
    <div>
        <b-form-group>
            <b-form-group
                :id="'range-' + form.content.id"
                :label="form.content.name"
                :label-for="'range-form-' + form.content.id"
            >
                Between {{ form.content.min }} & {{ form.content.max }}<br />
                <input
                    v-model="form.answer"
                    :min="form.content.min"
                    :max="form.content.max"
                    type="range"
                    :id="'range-form-' + form.content.id"
                    required
                    :disabled="loading"
                />
            </b-form-group>
        </b-form-group>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from "vue-property-decorator";

@Component
export default class RangeOrganism extends Vue {
    @Prop()
    loading: any;

    @Prop()
    form: any;
}
</script>
