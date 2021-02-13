import { mount } from '@vue/test-utils';
import ListForm from '../../resources/js/components/resume/dynamic/ListForm.vue';

function wrapper({
  title = 'test',
  placeholder = 'Test',
  model = {},
  self = 'test',
}) {
  return mount(ListForm, {
    propsData: {
      title,
      placeholder,
      model,
      self,
    },
  });
}

describe('ListForm', () => {
  it('renders empty model', () => {
    const model = {};
    const inputs = wrapper({ model }).findAll('input');
    expect(inputs.length).toEqual(0);
    expect(model).toEqual({});
  });

  it('renders empty entry', () => {
    const input = wrapper({ model: { test: [''] } }).find('input').element;
    expect(input.value).toEqual('');
  });

  it('renders entries with values', () => {
    const model = { test: ['test1', 'test2'] };
    const inputs = wrapper({ model }).findAll('input');
    model.test.forEach((s, i) => expect(inputs.at(i).element.value).toEqual(s));
  });

  it('modifies model correctly', async () => {
    const model = { test: ['test1', 'test2'] };
    const modif = ['mod1', 'mod2'];
    const inputs = wrapper({ model }).findAll('input');
    for (let i = 0; i < model.test.length; i++) {
      await inputs.at(i).setValue(modif[i]);
      expect(model.test[i]).toEqual(modif[i]);
    }
  });

  it('adds values to model', async () => {
    const model = { test: ['test1', 'test2'] };
    const component = wrapper({ model });
    const addButton = component.find('.btn-primary');
    await addButton.trigger('click');
    expect(model.test.length).toEqual(3);
    const inputs = component.findAll('input');
    expect(inputs.length).toEqual(3);
    expect(model.test[2]).toEqual('');
  });

  it("adds key if it doesn't exist", async () => {
    const model = {};
    const component = wrapper({ model });
    const addButton = component.find('.btn-primary');
    await addButton.trigger('click');
    expect(model.test).toBeDefined();
    expect(model.test).toEqual(['']);
  });

  it('deletes from model', async () => {
    const model = { test: ['test1', 'test2'] };
    const component = wrapper({ model });
    const deleteButton = component.find('.btn-danger');
    await deleteButton.trigger('click');
    expect(model.test.length).toEqual(1);
    const inputs = component.findAll('input');
    expect(inputs.length).toEqual(1);
  });
});
