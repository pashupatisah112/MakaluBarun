<template>
    <div>
        <slider></slider>
        <about></about>
        <projects></projects>
        <gallery></gallery>
    </div>
</template>
<script>
import Slider from '../../components/User/Home/Slider';
import About from '../../components/User/Home/About';
import Gallery from '../../components/User/Home/Gallery';
import Projects from '../../components/User/Home/Projects';
export default {
    components:{
        Slider,
        About,
        Gallery,
        Projects,
    },
    data(){
        return{

        }
    }
}
</script>