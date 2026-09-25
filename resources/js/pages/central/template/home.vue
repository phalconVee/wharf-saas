<template>
  <div class="landing">
    <template-nav />
    <hero-banner />
    <about />
    <why-us />
    <business-start />
    <features />
    <business-need />
    <extra-features />
    <cta />
    <screenshot />
    <pricing />
    <testimonial />
    <newsletter />
    <template-footer />
  </div>
</template>

<script>
import TemplateNav from '~/components/template/Navbar'
import HeroBanner from '~/components/template/HeroBanner'
import About from '~/components/template/About'
import WhyUs from '~/components/template/WhyUs'
import BusinessStart from '~/components/template/BusinessStart'
import Features from '~/components/template/Features'
import BusinessNeed from '~/components/template/BusinessNeed'
import ExtraFeatures from '~/components/template/ExtraFeatures'
import Cta from '~/components/template/Cta'
import Screenshot from '~/components/template/Screenshot'
import Pricing from '~/components/template/Pricing'
import Testimonial from '~/components/template/Testimonial'
import Newsletter from '~/components/template/Newsletter'
import TemplateFooter from '~/components/template/Footer'

export default {
  layout: "template",
  metaInfo() {
    return { title: 'Ultimate Sales, Inventory, Accounting Management SaaS Application.' }
  },
  components: {
    TemplateNav,
    HeroBanner,
    About,
    WhyUs,
    BusinessStart,
    Features,
    BusinessNeed,
    ExtraFeatures,
    Cta,
    Screenshot,
    Pricing,
    Testimonial,
    Newsletter,
    TemplateFooter
  },


};
</script>
<style scoped>
@import "../../../../sass/template.scss";
</style>
