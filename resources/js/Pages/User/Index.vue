<template>
    <div>
        <v-app>
            <appbar></appbar>
            <v-main>
                <router-view></router-view>
            </v-main>
            <pooter></pooter>
        </v-app>
    </div>
</template>
<script>
import Appbar from '../../components/User/Common/Appbar';
import Pooter from '../../components/User/Common/Footer';
export default {
    components:{
        Appbar,
        Pooter
    },
    data(){
        return{

        }
    }
}
</script>