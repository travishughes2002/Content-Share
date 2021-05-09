<template>
    <section>
        <h2>Custom Domain</h2>
        <p>Here you may add domains that you would like to use for shortcodes. Note: The domain must be setup manually.</p>

        <div >
            <table cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Domain</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody v-for="domain in customDomains" v-bind:key="domain.id">
                    <tr>
                        <td>{{ domain.id }}</td>
                        <td>{{ domain.domain }}</td>
                        <td>
                            <button v-on:click="deleteDomain(domain.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h3>Add New Domain</h3>
        <form method="POST" v-on:submit.prevent="addDomain">
            <div class="field-group">
                <input v-model="form.domain" type="text" placeholder="Name">
            </div>
            <div class="field-group">
                <button class="btn-primary" type="submit">Add Domain</button>
            </div>
        </form>
        
    </section>
</template>

<script>
    import axios from 'axios';
    import api from '../api';
    import notifications from '../Components/Notifications'

    export default {
        data: function() {
            return {
                customDomains: [],

                form: {
                    domain: ''
                }
            }
        },

        methods: {
            deleteDomain: function(id) {
                axios.delete('api/domains/delete/' + id).then((response) => {
                    this.customDomains.forEach(domain => {
                        console.log('looping: ' + domain.domain);
                        if(domain.id == id) {
                            return this.customDomains.splice(this.customDomains.indexOf(domain), 1);
                        }
                    });
                }).catch((error) => {
                    console.log(error);
                });
            },

            addDomain: function() {
                if(this.form.domain == '') {
                    return console.log('Domain cannot be blank.');
                } else if(!this.form.domain.includes('https://')) {
                    return console.log('Domain must contain https://');
                }

                axios.post('api/domains/store', this.form).then((response) => {
                    console.log('work');
                    this.$root.$refs.Notifications.addNotification('Added Domain Successfully', 'Success', false);
                }).catch((error) => {

                });
            },
        },

        mounted() {
            // Get all domains
            axios.get('/api/domains').then((response) => {
                this.customDomains = JSON.parse(response.request.response)['domains']; // Decode request and store it
            });

            // vue.addNotification('some text here', 'error', false);
        }
    }
</script>