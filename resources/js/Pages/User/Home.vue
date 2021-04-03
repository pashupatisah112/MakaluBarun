<template>
    <div>
        <slider></slider>
        <gallery></gallery>
        <projects></projects>
        <story></story>
    </div>
</template>
<script>
import Slider from '../../components/User/Home/Slider';
import Gallery from '../../components/User/Home/Gallery';
import Projects from '../../components/User/Home/Projects';
import Story from '../../components/User/Home/Stories';
export default {
    components:{
        Slider,
        Gallery,
        Projects,
        Story
    },
    data(){
        return{

        }
    }
}
</script>