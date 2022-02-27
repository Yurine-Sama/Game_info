<template>
  <div class="container">
    <div class="row">
      <div class="col">
        <table class="table">
          <thead class="table-dark">
            <tr>
              <th>product name</th>
              <th>price</th>
              <th>amount</th>
            </tr>
          </thead>
          <tbody>
            {{
              $orders
            }}
            <tr>
              <td>test</td>
              <td>200 $</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
