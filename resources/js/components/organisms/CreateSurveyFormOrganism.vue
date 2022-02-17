<template>
    <div>
        <hr />
        <b-card>
            <b-row>
                <b-col>
                    <b-form-group>
                        <b-form-group
                            :id="'input-form-group-' + index"
                            label="Name:"
                            :label-for="'input-form-' + index"
                        >
                            <b-form-input
                                :id="'input-form-' + index"
                                v-model="form.name"
                                type="text"
                                placeholder="Enter field name"
                                :disabled="loading"
                                required
                            ></b-form-input>
                        </b-form-group>
                    </b-form-group>
                </b-col>
                <b-col>
                    <b-form-group
                        :id="'input-form-group-' + index"
                        label="Name:"
                        :label-for="'input-form-' + index"
                    >
                        <b-form-select
                            v-model="form.type"
                            :options="options"
                            :disabled="loading"
                            size="sm"
                        ></b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>
            <br />
            <template v-if="form.type === 'string' || form.type === 'text'">
                <b-form-group
                    :id="'cc-input-form-group-' + index"
                    label="Character count:"
                    :label-for="'cc-input-form-' + index"
                    description="-1 for unlimited"
                >
                    <b-form-input
                        :id="'cc-input-form-' + index"
                        v-model="form.char_count"
                        :disabled="loading"
                        type="number"
                        placeholder="Enter character count"
                        required
                    ></b-form-input>
                </b-form-group>
                <br />
            </template>
            <template
                v-if="form.type === 'datepicker' || form.type === 'range'"
            >
                <b-row>
                    <b-col>
                        <b-form-group
                            :id="'min-input-form-group-' + index"
                            label="Min value:"
                            :label-for="'min-input-form-' + index"
                        >
                            <b-form-input
                                :id="'min-input-form-' + index"
                                v-model="form.min"
                                :type="
                                    form.type === 'range' ? 'number' : 'date'
                                "
                                placeholder="Enter min/start value"
                                :disabled="loading"
                                :required="form.type === 'range'"
                            ></b-form-input>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            :id="'max-input-form-group-' + index"
                            label="Max value:"
                            :label-for="'max-input-form-' + index"
                        >
                            <b-form-input
                                :id="'max-input-form-' + index"
                                v-model="form.max"
                                :type="
                                    form.type === 'range' ? 'number' : 'date'
                                "
                                :disabled="loading"
                                placeholder="Enter max/end value"
                                :required="form.type === 'range'"
                            ></b-form-input>
                        </b-form-group>
                    </b-col>
                </b-row>
                <br />
            </template>
            <template
                v-if="
                    form.type === 'checkbox' ||
                    form.type === 'radio' ||
                    form.type === 'dropdown'
                "
            >
                <template v-for="(option, oi) in form.options">
                    <div :key="oi">
                        <b-row>
                            <b-col sm="5">
                                <b-form-group
                                    :id="
                                        'key-input-form-group-' +
                                        index +
                                        '-' +
                                        oi
                                    "
                                    label="Key:"
                                    :label-for="
                                        'key-input-form-' + index + '-' + oi
                                    "
                                >
                                    <b-form-input
                                        :id="
                                            'key-input-form-' + index + '-' + oi
                                        "
                                        v-model="option.key"
                                        type="text"
                                        placeholder="Enter key"
                                        :disabled="loading"
                                        required
                                    ></b-form-input>
                                </b-form-group>
                            </b-col>
                            <b-col sm="5">
                                <b-form-group
                                    :id="
                                        'value-input-form-group-' +
                                        index +
                                        '-' +
                                        oi
                                    "
                                    label="Value:"
                                    :label-for="
                                        'value-input-form-' + index + '-' + oi
                                    "
                                >
                                    <b-form-input
                                        :id="
                                            'value-input-form-' +
                                            index +
                                            '-' +
                                            oi
                                        "
                                        v-model="option.value"
                                        type="text"
                                        :disabled="loading"
                                        placeholder="Enter value"
                                        required
                                    ></b-form-input>
                                </b-form-group>
                            </b-col>
                            <b-col sm="2">
                                <b-button
                                    variant="danger"
                                    @click="deleteOption(oi)"
                                    :disabled="loading"
                                    size="sm"
                                    >Delete</b-button
                                >
                            </b-col>
                        </b-row>
                        <br />
                    </div>
                </template>
                <b-button @click="addOption" size="sm" :disabled="loading"
                    >Add new option</b-button
                >
                <br />
                <br />
            </template>
            <template v-if="form.type === 'file'">
                <b-row>
                    <b-col>
                        <b-form-group
                            :id="'file-size-input-form-group-' + index"
                            label="Files size in kb:"
                            :label-for="'file-size-input-form-' + index"
                            description="-1 for unlimited"
                        >
                            <b-form-input
                                :id="'file-size-input-form-' + index"
                                v-model="form.max_size"
                                type="number"
                                placeholder="Maximum file size in kb"
                                :disabled="loading"
                                required
                            ></b-form-input>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group
                            :id="'format-input-form-group-' + index"
                            label="Format:"
                            :label-for="'format-input-form-' + index"
                        >
                            <b-form-input
                                :id="'format-input-form-' + index"
                                v-model="form.values"
                                type="text"
                                placeholder="Enter file extension separate by comma (png,svg)"
                                :disabled="loading"
                                required
                            ></b-form-input>
                        </b-form-group>
                    </b-col>
                </b-row>
                <br />
            </template>
            <b-button
                variant="danger"
                @click="deleteForm"
                size="sm"
                :disabled="loading"
            >
                Delete form
            </b-button>
        </b-card>
    </div>
</template>

<script lang="ts">
import { Component, Emit, Prop, Vue } from "vue-property-decorator";

@Component
export default class CreateSurveyFormOrganism extends Vue {
    @Prop()
    index?: any;

    @Prop()
    form?: any;

    @Prop()
    loading?: any;

    @Emit("deleteForm")
    deleteForm() {}

    private options = [
        {
            value: "text",
            text: "Text",
        },
        {
            value: "string",
            text: "Input",
        },
        {
            value: "datepicker",
            text: "Date picker",
        },
        {
            value: "checkbox",
            text: "Checkbox",
        },
        {
            value: "radio",
            text: "Radio",
        },
        {
            value: "dropdown",
            text: "Dropdown",
        },
        {
            value: "file",
            text: "File",
        },
        {
            value: "range",
            text: "Range",
        },
    ];

    addOption() {
        this.form.options.push({
            key: "",
            value: "",
        });
    }

    deleteOption(index: number) {
        this.form.options.splice(index, 1);
    }
}
</script>
