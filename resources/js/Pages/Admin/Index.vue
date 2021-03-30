<template>
    <div>
        <v-app>
            <drawer></drawer>
            <appbar></appbar>
            <v-main>
                <router-view></router-view>
            </v-main>
        </v-app>
    </div>
</template>
<script>
import Appbar from '../../components/Admin/Common/Appbar';
import Drawer from '../../components/Admin/Common/Drawer';
export default {
    components:{Appbar,Drawer},
    data(){
        return{

        }
    },
    created(){
        this.isAdmin()
    },
    methods:{
        isAdmin(){
            if(!localStorage.getItem('token')){
                this.$router.push({
                    name:'AdminLogin'
                })
            }
        }
    }
}
</script>