<template>
    <div>

        <button  v-if="readBy" class="no-underline  bg-orange tracking-wide text-white font-semibold  py-3 px-6  hover:border-or
        -dark rounded mr-4" @click="unread()">
                  <i class="fa fa-check-circle"></i>  Mark as Unread
        </button>

        <button href="http://127.0.0.1:8000/login" v-else @click="read()" class="no-underline  bg-transparent tracking-wide hover:bg-orange text-orange font-semibold hover:text-white py-3 px-6 border-2 border-orange hover:border-transparent rounded mr-4">
                                              Mark as Read
        </button>


    </div>
</template>


<script>
    export default {
        props: ['isRead', 'id'],

        data() {
            return {
                readBy: false,
                form: {
                    email: '',
                    password: ''
                }
            }
        },

        created() {
            this.readBy = this.isRead;
        },

        methods: {
            unread() {
                var self = this;
                axios.get('/wiki/' + this.id + '/unread').then(function(response){
                    self.readBy = false;
                    $('#isReadCheck').hide();
                });
            },

             read() {
                var self = this;
                axios.get('/wiki/' + this.id + '/read').then(function(response){
                    self.readBy = true;
                    $('#isReadCheck').show();
                });
            }
        }


    }
</script>