<!--base template for every page-->
<template>
<!-- key loads different data in same component..like in projects page !!imp -->
    <router-view :key="$route.fullPath"></router-view>
</template>