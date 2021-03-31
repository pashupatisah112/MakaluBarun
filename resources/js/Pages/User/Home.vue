<template>
    <div>
        <slider></slider>
        <projects></projects>
        <story></story>
    </div>
</template>
<script>
import Slider from '../../components/User/Home/Slider';
import Projects from '../../components/User/Home/Projects';
import Story from '../../components/User/Home/Stories';
export default {
    components:{
        Slider,
        Projects,
        Story
    },
    data(){
        return{

        }
    }
}
</script>