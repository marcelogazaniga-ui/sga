<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>

    <div
        x-data="{
            value: @entangle($getStatePath()),

            formatMoney(value) {

                let number = value.replace(/\D/g, '');

                if (!number) {
                    return '';
                }


                number = (parseInt(number) / 100)
                    .toFixed(2);


                let parts = number.split('.');


                parts[0] = parts[0]
                    .replace(
                        /\B(?=(\d{3})+(?!\d))/g,
                        '.'
                    );


                return parts[0] + ',' + parts[1];

            }

        }"
    >

        <div class="fi-input-wrp">

            <div class="fi-input-wrp-prefix">

                R$

            </div>


            <input

                type="text"

                x-model="value"

                x-on:input="
                    value = formatMoney($event.target.value)
                "

                class="
                    fi-input
                    block
                    w-full
                    rounded-lg
                    border-gray-300
                    shadow-sm
                    dark:border-gray-700
                    dark:bg-gray-900
                    dark:text-white
                "

            >

        </div>


    </div>

</x-dynamic-component>
