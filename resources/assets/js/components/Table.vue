<template>
<table>
    <thead>
      <slot name="header"></slot>
    </thead>

    <tbody>
      <slot name="body"></slot>
    </tbody>

    <tfoot>
      <slot name="footer"></slot>
    </tfoot>
</table>
</template>


<script>
export default {};
</script>
