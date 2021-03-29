<template>
    <div>
        <slider></slider>
        <causes></causes>
        <projects></projects>
        <story></story>
    </div>
</template>
<script>
import Slider from '../../components/User/Home/Slider';
import Causes from '../../components/User/Home/Causes';
import Projects from '../../components/User/Home/Projects';
import Story from '../../components/User/Home/Stories';
export default {
    components:{
        Slider,
        Causes,
        Projects,
        Story
    },
    data(){
        return{

        }
    }
}
</script>