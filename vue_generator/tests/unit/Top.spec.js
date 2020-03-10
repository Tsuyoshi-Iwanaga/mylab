import { shallowMount } from "@vue/test-utils";
import TargetComponent from "@/components/HelloWorld.vue";

describe("HelloWorld.vue", () => {
  it("render", () => {
    const wrapper = shallowMount( TargetComponent, {
      propsData: { msg: 'hoge' }
    });
    expect(wrapper.find("h1").text()).toMatch('hoge');
  });
});
