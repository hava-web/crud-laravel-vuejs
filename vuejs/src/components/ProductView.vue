<script lang="ts">

import Vue from 'vue';
import axios from 'axios';

interface product{
  id: number;

}

 export default {
  data() {
      return {
        result: {

        },
        product:{
          id: '',
          name: '',
          description: '',
          quantity: '',
          price: '',
        }
      }
    },
  created() {
    this.ProductLoad();
  },
  methods : {
    ProductLoad()
    {
      console.log('LoadTask() calling...');
      var page = 'http://127.0.0.1:8000/api/products';
      axios.get(page)
        .then(
          ({data})=>{
            console.log(data);
            this.result = data;
          }
        );
    },
    save()
    {
      if(this.product.id)
      {
        this.updated();
      }
      else
      {
        this.saveData();
      }
    },
    saveData()
    {
      axios.post('http://127.0.0.1:8000/api/save',this.product)
      .then(
        ({data})=>{
          alert('Data Saved !');
        }
      )
    },
    edit(product)
    {
        this.product = product;
    },
    updated() {
        var edit = 'http://127.0.0.1:8000/api/update/' + this.product.id;
        axios.put(edit,this.product)
        .then(
          ({data})=>{
            this.product.name = '';
            this.product.description = '';
            this.product.quantity = '';
            this.product.price = '';
            alert('Product Updated !');
            this.ProductLoad();
          }
        )
    },
    remove(product)
    {
      var remove = 'http://127.0.0.1:8000/api/delete/'+ product.id;
      axios.delete(remove);
      alert('Product Deleted Successfully !');
      this.ProductLoad();
    }
  }
 }
</script>
<template>
  <div class="greeting">
      <h2>Product Form</h2>
    <form @submit.prevent="save">
  <div class="mb-3 ">
    <label for="" class="form-label">Name Product</label>
    <input type="text" name="name" v-model="product.name" class="form-control" id="" >
  </div>
  <div class="mb-3">
    <label for="" class="form-label">Description</label>
    <textarea name="description" id="" cols="30" v-model="product.description" class="form-control" rows="5"></textarea>
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="mb-3">
        <label for="" class="form-label">Quantity</label>
        <input type="number" name="quantity" v-model="product.quantity" class="form-control">
      </div>
    </div>
    <div class="col-md-4">
      <div class="mb-3">
        <label for="" class="form-label">Price</label>
        <input type="number" name="price" v-model="product.price" class="form-control">
      </div>
    </div>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  <br>
  <br>

  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Option</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product in result" v-bind:key="product['id']">
        <td>{{ product['name'] }}</td>
        <td>{{ product['description'] }}</td>
        <td>{{ product['quantity'] }}</td>
        <td>{{ product['price'] }}</td>
        <td>
          <button class="btn btn-primary" @click="edit(product)">Edit</button>
          <button class="btn btn-danger" @click="remove(product)">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
  </div>
</template>
