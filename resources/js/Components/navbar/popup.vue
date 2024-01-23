<script setup>
    const props = {
        isOpen:{
            type:Boolean,
            default:false,
        },
        onClose: {
            type : Function,
            default:()=>{}, 
        },

    }

    const closePopup = () => {
        props.onClose();
        props.isOpen = false;
    }

</script>



<template>
    <div  v-show="isOpen"  @click="closePopup">
        <div class="popup fixed top-0 left-0 w-11 h-screen">
            <slot/>
            
        </div>
    </div>
</template>