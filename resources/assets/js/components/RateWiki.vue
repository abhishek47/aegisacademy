<template>
    <div>
        <star-rating  active-color="#ffed4a" :glow="10" :star-size="size" :border-width="4" border-color="#d8d8d8" :rounded-corners="true" :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]" :rating="rating" :read-only="!canEdit" :show-rating="canEdit" @rating-selected="setWikiRating"></star-rating>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'

    export default {
        props: ['id', 'userRating', 'size', 'edit'],

        components: {
            'star-rating': StarRating
         },

        data() {
            return {
                rating: 0,
                canEdit: true,
            }
        },

        created() {
            this.rating = this.userRating;
            this.canEdit = this.edit;
        },

        methods: {
            setWikiRating(rating) {
                this.rating = rating;
                var self = this;
                axios.post('/wiki/' + this.id + '/rate', {rating: rating}).then(function(response){
                    alert('Thank you for your feedback!');
                });

            }
        }
    }
</script>

