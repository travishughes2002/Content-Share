<template>
    <span class="msg error">
        <strong>{{ message }}</strong>
        <button>
            <i class="fas fa-times"></i>
        </button>
    </span>
</template>
<script>
    export default {
        data: function() {
            return {
                type: {
                    default: error
                },
                message: ''
            }
        },

        methods: {

        }
    }
</script>