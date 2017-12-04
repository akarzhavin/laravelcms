<template>
  <div class="vue-part">
    <div class="form-group">
      <label for="properties[status]">Статус</label>
      <select id="awesomee" class="form-control" name="properties[status]"><option value="A" selected="selected">Включено</option><option value="D">Выключено</option><option value="H">Скрыто</option></select>
    </div>
    <div class="form-group">
      <label for="properties[type]">Тип характеристики</label>
      <select id="awesomee" class="form-control" name="properties[type]" v-on:change="featureChange" v-model="selected">
        <optgroup label="Флажок">
          <option value="CheckSingle">Один</option>
          <option value="CheckMulti">Несколько</option>
        </optgroup>
        <optgroup label="Список вариантов">
           <option value="SelectNum">Текст</option>
           <option value="SelectText">Число</option>
        </optgroup>
      </select>
    </div>

    <div class="form-group">
      <label for="description[title]">Заголовок</label>
      <input class="form-control" name="description[title]" type="text" value="" id="description[title]">

      <label for="description[description]">Описание</label>
      <textarea class="form-control" name="description[description]" cols="50" rows="10" id="description[description]"></textarea>
    </div>

    <div class="form-group">
      <label for="description[prefix]">Префикс</label>
      <input class="form-control" name="description[prefix]" type="text" value="" id="description[prefix]">

      <label for="description[suffix]">Суффикс</label>
      <input class="form-control" name="description[suffix]" type="text" value="" id="description[suffix]">
    </div>


    <h4>Выбор категорий</h4>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Категории (зажмите Ctrl, чтобы выбрать несколько категорий)</label>
      <select multiple class="form-control" name="categories[]" id="exampleFormControlSelect2">
        <option  value="1">Все категории</option><option  value="2">-cumque</option><option  value="13">--sunt</option><option  value="4">-ipsa</option><option  value="7">-dignissimos</option><option  value="9">--unde</option><option  value="10">-aut</option><option  value="14">-neque</option><option  value="16">-dolor</option><option  value="17">--velit</option><option  value="3">---et</option><option  value="28">----soluta</option><option  value="45">---qui</option><option  value="33">----animi</option><option  value="21">-cupiditate</option><option  value="22">-explicabo</option><option  value="19">--quisquam</option><option  value="6">---aut</option><option  value="50">----esse</option><option  value="38">--culpa</option><option  value="32">---ut</option><option  value="23">----similique</option><option  value="35">----atque</option><option  value="44">--enim</option><option  value="12">---et</option><option  value="8">----atque</option><option  value="49">--id</option><option  value="26">---quam</option><option  value="24">-ducimus</option><option  value="46">--exercitationem</option><option  value="29">-ipsam</option><option  value="27">--dolor</option><option  value="30">-quos</option><option  value="18">--voluptatem</option><option  value="31">-alias</option><option  value="34">-explicabo</option><option  value="36">-vel</option><option  value="15">--quis</option><option  value="37">-officiis</option><option  value="41">-sed</option><option  value="25">--officiis</option><option  value="42">-at</option><option  value="43">-iure</option><option  value="40">--dolorem</option><option  value="39">---ad</option><option  value="47">-laudantium</option><option  value="5">--voluptas</option><option  value="20">---cupiditate</option><option  value="48">-nulla</option><option  value="52">-234</option>    </select>
    </div>

    <h4>Варианты</h4>
    <ul v-model="variants">
      <li v-bind:id="variant.id" v-for="variant in variants" v-on:click="editList">
        {{variant.text}}
      </li>
    </ul>
    <div v-show="!visible" class="add__block">
      <label for="add">Add</label>
      <input name="add" type="input" v-model.lazy="inputAddVal" value="inputAddVal">
      <button id="add-variant" class="btn btn-primary btn-img-product-form" type="button" v-on:click="addNewValue"><i class="fa fa-plus-circle" aria-hidden="true"></i> add</button>
    </div>
    <div class="edit__block" v-show="visible">
      <label for="add">Edit</label>
      <input name="edit" type="input" v-model.lazy="inputEditVal" value="inputEditVal">
      <button id="edit-variant" class="btn btn-warning btn-img-product-form" type="button" v-on:click="editDone"><i class="fa fa-plus-circle"></i> edit</button>
    </div>

  </div>

</template>

<script>

  export default {
    //props: ['variants'],
    data() {
      return {
        variants: [],
        inputAddVal: '',
        inputEditVal: '',
        elId: 0,
        elVal: '',
        visible: false
      }
    },
    methods: {
      addNewValue: function () {
        this.variants.push({
          id: this.variants.length,
          text: this.inputAddVal
        });
        this.inputAddVal = '';
      },
      editList: function (e) {
        this.elVal = e.target.innerHTML.trim();
        this.inputEditVal = this.elVal;
        this.visible = true;
        this.elId = e.target.id;

      },
      editDone: function () {
        debugger;
        this.variants.filter(variant => {
          if (variant.id === +this.elId) variant.text = this.inputEditVal;
        });
        this.visible = false;

      }
    }

  };
</script>

<style scoped>

</style>