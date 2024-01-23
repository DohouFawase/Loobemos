<template>

    <div class="
        border-[1px]
        w-auto
        hiddenobject
        rounded-full
        shadow-md
        hover:shadow-md
        transition
        cursor-pointer
    ">
        <div class="
            flex
            flex-row
            items-center
            justify-between
        ">
           
            <div  class="flex w-full  justify-center items-center">
          <input
              class="flex  border-[#fff] px-4 py-1 my-2 mx-2  items-center justify-center  border-transparent rounded-full w-[100%]"
              type="text"
              autocomplete="off"
              name="search"
              placeholder="Vous pouvez rechercher ici..."
              style="outline: none;"
            />
          <div class="bg-[#4663ff] w-8 h-6 rounded-full flex items-center justify-center my-2 mx-2 text-white ">
            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="presentation" focusable="false" style="display: block; fill: none; height: 12px; width: 12px; stroke: currentcolor; stroke-width: 5.33333; overflow: visible;"><g fill="none">
              <path d="m13 24c6.0751322 0 11-4.9248678 11-11 0-6.07513225-4.9248678-11-11-11-6.07513225 0-11 4.92486775-11 11 0 6.0751322 4.92486775 11 11 11zm8-3 9 9"></path></g>
            </svg>
          </div> 
        </div>
        </div>
    </div>

</template>
<style>
@media(max-width: 728px){
  .hiddenobject{
    display: none;
  }
}
</style>