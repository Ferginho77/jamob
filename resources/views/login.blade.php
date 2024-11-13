@extends('layouts.header')

<div class="container">
  <div class="heading">Login</div>
  <form class="form" action="/login" method="post">
    @csrf
    <div class="input-field">
      <input type="text" name="username" required>
      <label for="username">Username</label>
    </div>
    <div class="input-field">
      <input type="password" name="password" required>
      <label for="username">Password</label>
    </div>

    <div class="btn-container">
      <button class="btn" type="submit">Submit</button>
    </div>
  </form>
</div>
@section('title', 'LOGIN PAGE')
<style>
   html, body {
    height: 100%; 
    margin: 0; 
}

.container {
    border: solid 1px #8d8d8d;
    padding: 20px;
    border-radius: 20px;
    background-color: #fff;
    max-width: 400px; 
    margin: auto; 
    position: absolute; 
    top: 50%; 
    left: 50%; 
    transform: translate(-50%, -50%); 
}
  .container .heading {
    font-size: 1.3rem;
    margin-bottom: 20px;
    font-weight: bolder;
    font-family: sans-serif;
  }
  
  .form {
    max-width: 300px;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }
  
  .form .btn-container {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 20px;
  }
  
  .form .btn {
    padding: 10px 20px;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 3px;
    border-radius: 10px;
    border: solid 1px #1034aa;
    border-bottom: solid 1px #90c2ff;
    background: linear-gradient(135deg, #0034de, #006eff);
    color: #fff;
    font-weight: bolder;
    transition: all 0.2s ease;
    box-shadow: 0px 2px 3px #000d3848, inset 0px 4px 5px #0070f0,
      inset 0px -4px 5px #002cbb;
  }
  
  .form .btn:active {
    box-shadow: inset 0px 4px 5px #0070f0, inset 0px -4px 5px #002cbb;
    transform: scale(0.995);
  }
  
  .input-field {
    position: relative;
  }
  
  .input-field label {
    position: absolute;
    color: #8d8d8d;
    pointer-events: none;
    background-color: transparent;
    left: 15px;
    transform: translateY(0.6rem);
    transition: all 0.3s ease;
  }
  
  .input-field input {
    padding: 10px 15px;
    font-size: 1rem;
    border-radius: 8px;
    border: solid 1px #8d8d8d;
    letter-spacing: 1px;
    width: 100%;
  }
  
  .input-field input:focus,
  .input-field input:valid {
    outline: none;
    border: solid 1px #0034de;
  }
  
  .input-field input:focus ~ label,
  .input-field input:valid ~ label {
    transform: translateY(-51%) translateX(-10px) scale(0.8);
    background-color: #fff;
    padding: 0px 5px;
    color: #0034de;
    font-weight: bold;
    letter-spacing: 1px;
    border: none;
    border-radius: 100px;
  }
  
  .form .passicon {
    cursor: pointer;
    font-size: 1.3rem;
    position: absolute;
    top: 6px;
    right: 8px;
  }
  
  .form .close {
    display: none;
  }
  
</style>

