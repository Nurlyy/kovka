<template>
  <div class="gallery">
    <div class="navigation-gallery">
      <button :class="active" @click="gallery_1">Декор для сада</button>
      <button :class="active2" @click="gallery_2">Интерьер жилого пространства</button>
      <button :class="active3" @click="gallery_3">Играждения и ворота</button>
    </div>
    <div class="gallery-list-photo" v-show="gallereActive_1">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
    <div class="gallery-list-photo" v-show="gallereActive_2">
      <div class="green"></div>
      <div class="green"></div>
      <div class="green"></div>
      <div class="green"></div>
      <div class="green"></div>
      <div class="green"></div>
    </div>
    <div class="gallery-list-photo" v-show="gallereActive_3">
      <div class="red"></div>
      <div class="red"></div>
      <div class="red"></div>
      <div class="red"></div>
      <div class="red"></div>
      <div class="red"></div>
    </div>
    <div class="gallery-text" :class="maxheightClass">
      <h2>
        Кованная мебель для сада от Владимира Тарана
      </h2>
      <div class="conteaner-text">
        <p>
          Кованая мебель - популярный пример применения художественной ковки в интерьере и экстерьере. Скамьи, качели, летние беседки, перголы, столы и стулья, зоны для барбекю, арки и калитки - все они могут быть изготовлены из кованого металла и использованы как внутри дома, так и на улице. 
        </p>
        <p>
          Художественная ковка - это искусство, которое существует уже много лет. Но в этом году мы можем наблюдать новое прочтение классических элементов художественной ковки. Стремление к простым четким линиям стало одним из самых модных трендов в области ковки. Новое прочтение классических элементов позволяет создавать более современные и стильные изделия, которые подходят для внутреннего или внешнего оформления уголков отдыха в саду и прекрасно вписываются в современные концепции ландшафтного дизайна.
        </p>
        <p>
          Традиционные элементы художественной ковки, такие как листья, цветы и ветви, по-прежнему остаются популярными. Однако, сейчас дизайнеры все больше отдают предпочтение простым геометрическим формам и четким линиям. Тенденции современного дизайна приходят в наиболее консервативные отрасли, такие как производство кованой и металлической мебели.
        </p>
        <p>
          Одной из особенностей этого тренда является использование не только черного металла, но и других цветов. Кованые изделия с яркими цветами могут быть использованы для создания ярких акцентов в интерьере или экстерьере.
        </p>
        <p>
          В целом, новое прочтение классических элементов художественной ковки - это модный тренд, который позволит создать уникальные и красивые предметы для вашего летнего сада.
        </p>
        <p>
          Наша компания является производителем качественной кованой мебели для сада и дома. Мы специализируемся на создании уникальных изделий, которые производятся по индивидуальным проектам заказчиков. 
        </p>
        <p>
          Мы понимаем, что каждый клиент имеет свои собственные потребности и желания. Мы работаем в тесном сотрудничестве с заказчиками, чтобы понять их требования и создать мебель, которая будет соответствовать их вкусу и стилю.
        </p>
        <p>
          Свяжитесь с нами для обсуждения вашего проекта!
        </p>
      </div>
      <div class="conteaner-hidden-botton" :class="dnoneActive">
        <div class="conteaner-gradient">
          <button @click="maxheightClass = 'maxheight', dnoneActive = 'dnone'">Читать полностью</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Gallery',
  data() {
  	return {
	    gallereActive_1: true,
      gallereActive_2: false,
      gallereActive_3: false,
      active: 'active',
      active2: '',
      active3: '',
      maxheightClass: '',
      dnoneActive: ''
  	}
	},
  methods: {
    gallery_1() {
      if (this.gallereActive_1 = true) {
        this.gallereActive_2 = false;
        this.gallereActive_3 = false;
      }
      if (this.active = 'active') {
        this.active2 = '';
        this.active3 = '';
      }
    },
    gallery_2() {
      if (this.gallereActive_2 = true) {
        this.gallereActive_1 = false;
        this.gallereActive_3 = false;
      }
      if (this.active2 = 'active') {
        this.active = '';
        this.active3 = '';
      }
    },
    gallery_3() {
      if (this.gallereActive_3 = true) {
        this.gallereActive_1 = false;
        this.gallereActive_2 = false;
      }
      if (this.active3 = 'active') {
        this.active2 = '';
        this.active1 = '';
      }
    }
  },
}
</script>

<style scoped lang="scss">
.gallery {
  .navigation-gallery {
    width:var(--width-main);
    height:30px;
    border-bottom:2px solid #c9c9c9;
    text-align: center;
    button {
      border:0;
      outline: 0;
      background-color: none;
      background: none;
      cursor: pointer;
      border-bottom:2px solid #c9c9c9;
      color: #888888;
      text-transform: uppercase;
      font-size: 13px;
      font-weight: 600;
      font-family: var(--font-family-btn-navigation);
      transition: var(--transition);
      padding: 0 20px 13px 20px;
      &.active {
        color: #000;
        border-bottom:2px solid #000;
      }
      &:hover {
        color: #000;
      }
    }
  }
  .gallery-list-photo {
    display: grid;
    position: relative;
    margin-top:20px;
    grid-template-columns: repeat(3, 1fr);
    grid-template-rows: repeat(2, 280px);
    gap:1px;
    div {
      background-color: #d4d4d4;
      &.red {
        background-color: #dd3f3f;
      }
      &.green {
        background-color: #8bdd3f;
      }
    }
  }
  .gallery-text {
    position: relative;
    width:var(--width-main);
    background-color: #fafafa;
    height:510px;
    padding:70px 20px;
    box-sizing: border-box;
    margin-top:1px;
    overflow: hidden;
    &.maxheight {
      height:auto !important;
    }
    h2 {
      display: block;
      padding: 0;
      margin: 0;
      text-align: center;
      width:var(--width-main);
      color:var(--color-purple-h2);
      font-size: var(--font-saze-h2);
      font-family: var(--font-family-neumann);
      font-weight: normal;
    }
    .conteaner-text {
      max-width:678px;
      margin:0 auto;
      box-sizing: border-box;
      p {
        width:100%;
        color:#3b3b3b;
        font-size: var(--font-saze-p-gallery);
        line-height: 22px;
        font-family: var(--font-family-times);
        text-align: center;
        padding:10px 0;
        margin:0;
        text-align: justify;
      }
    }
    .conteaner-hidden-botton {
      position: absolute;
      bottom:0;
      left:0;
      width:100%;
      height:300px;
      text-align: center;
      &.dnone {
        display: none;
      }
      &::after {
        content: '';
        position: absolute;
        bottom:0;
        left:0;
        width:100%;
        height:270px;
        background: rgb(2,0,36);
        background: linear-gradient(180deg, rgba(250,250,250,0) 0%, rgba(250,250,250,0.9) 30%, rgba(250,250,250,1) 50%, rgba(250,250,250,1) 100%);
      }
      button {
        border:0;
        outline: none;
        height:40px;
        box-sizing: border-box;
        background-color: #412b5f;
        color:var(--color-white);
        font-weight: var(--font-weight-btn-navigation);
        font-family: var(--font-family);
        font-size: 14px;
        padding: 0 20px;
        position: relative;
        z-index: 2;
        margin-top:170px;
        cursor: pointer;
      }
    }
  }
}
</style>
