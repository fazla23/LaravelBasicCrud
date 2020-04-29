
<<template>
    <div>
        <!-- the line below is used for getting data from backend with the help of axios..which uses api/vue..
        that hits the controller TestingVueController and from there fetch data for us -->
        <button :type="type" class="my-button" v-text="test.name"></button>  
        
        <!-- <button :type="type" class="my-button" v-text="text"></button>  it is used for getting data directly from props-->

        
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')

            axios.post('api/vue',{})
                .then(response =>{
                    this.test = response.data;
                });
        },
        
        data:function(){
            return {
                test:null,
            }
        },

        props:[
        'text',
        'type'
        ]
    }

</script>

<style>
    .my-button{
        background-color : #333 ;
        color: #fff;
        padding: 10px 15px;
        font-weight: bold;
    }
</style>