<template>
    <div>
        <div class="d-flex justify-content-center align-items-center vh-100">

            <div class="shipping-calc">
                <h1 class="shipping-calc__title">Shipping calculator</h1>

                <BForm @submit="onSubmit" class="mb-3">
                    <BFormGroup
                        id="input-group-1"
                        label="Parcel weight (kg):"
                        label-for="input-1"
                        class="mb-3"
                    >
                        <b-form-input
                            id="input-1"
                            v-model="form.weight"
                            type="number"
                            placeholder="Enter weight of parcel"
                            required
                            min="1"
                        ></b-form-input>
                    </BFormGroup>

                    <BFormGroup
                        id="input-group-3"
                        label="Shipping carrier:"
                        label-for="input-3"
                        class="mb-3"
                    >
                        <BFormSelect
                            id="input-3"
                            v-model="form.carrier"
                            :options="carriers"
                            required
                        ></BFormSelect>
                    </BFormGroup>

                    <div class="shipping-calc__btn d-flex justify-content-center">
                        <BButton
                            type="submit"
                            variant="primary"
                            :disabled="!isFormValid || loading"
                        >
                            <span class="loading" v-if="loading"></span>
                            {{ loading ? 'Calculating...' : 'Calculate price' }}
                        </BButton>
                    </div>
                </BForm>

                <BAlert
                    flush
                    :model-value="!!result"
                    :dismissible="true"
                    variant="success"
                    class="shipping-calc__result shipping-calc__result-success"
                >
                    <h3 class="shipping-calc__result-title">✓ Shipping Cost</h3>
                    <div class="price">€{{ result?.price }}</div>
                    <div class="details">
                        Carrier: {{ result?.carrier }}<br>
                        Weight: {{ result?.weightKg }} kg<br>
                        Currency: {{ result?.currency }}
                    </div>
                </BAlert>

                <BAlert
                    flush
                    :model-value="!!error"
                    :dismissible="true"
                    variant="danger"
                    class="shipping-calc__result shipping-calc__result-error error"
                >
                    <h3 class="shipping-calc__result-title">✗ Error</h3>
                    <p>{{ error }}</p>
                </BAlert>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            loading: false,
            carriers: [],
            error: null,
            form: {
                weight: null,
                carrier: null,
            },
            result: null,
            apiShippingUrl: 'http://localhost:8080/api/shipping',
        }
    },
    created() {
        this.fetchCarriers();
    },
    computed: {
        isFormValid() {
            return this.form.weight > 0 && this.form.carrier !== null;
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()

            this.calculatePrice(this.form);
        },
        async fetchCarriers() {
            try {
                let carriersResponse = await axios.get(this.apiShippingUrl + '/carriers');
                let carriers = carriersResponse.data;

                if (carriers) {
                    for (const value of Object.values(carriers)) {
                        this.carriers.push({
                            text: value.name,
                            value: value.slug,
                        });
                    }
                }
            } catch (err) {
                this.error = err.response?.data?.message ?? err.message;
            }
        },
        async calculatePrice(form) {
            try {
                this.loading = true;

                let response = await axios.post(this.apiShippingUrl + '/calculate', {
                    weightKg: parseFloat(form.weight),
                    carrier: form.carrier,
                });
                let calculatedData = response.data;

                if (calculatedData.carrier) {
                    this.result = calculatedData;
                }
            } catch (err) {
                this.error = err.response?.data?.message ?? err.message;
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>

<style>
.orchestrator-container {
    display: none;
}

.shipping-calc__result-title {
    font-size: 20px;
}

.loading {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #667eea;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin-right: 10px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

body {
    background: #2A7B9B;
    background: linear-gradient(90deg,rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);
}

.shipping-calc {
    background-color: #fff;
    padding: 46px;
    border-radius: 24px;
}

.shipping-calc__title {
    font-size: 20px;
    text-align: center;
    margin-bottom: 25px;
}
</style>