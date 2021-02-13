import { mount } from '@vue/test-utils';
import DynamicForm from '../../resources/js/components/resume/dynamic/DynamicForm.vue';

const schema = {
  fields: [
    {
      type: 'input',
      inputType: 'text',
      label: 'Input One',
      placeholder: 'Test One',
      model: 'testOne',
    },
    {
      type: 'input',
      inputType: 'text',
      label: 'Input Two',
      placeholder: 'Test Two',
      model: 'testTwo',
    },
  ],
};

const subforms = [
  {
    component: {
      template: '<h1>Test</h1>',
      props: ['model'],
    },
  },
];

function wrapper(model, title = 'Test', self = 'test', alternativeSchema = null) {
  return mount(DynamicForm, {
    propsData: {
      model,
      title,
      self,
      schema: alternativeSchema || schema,
    },
  });
}

function createModel() {
  return {
    test: [
      {
        testOne: '',
        testTwo: '',
      },
    ],
  };
}

describe('DynamicForm', () => {
  it('renders empty entry', () => {
    const model = createModel();
    const component = wrapper(model);
    const inputs = component.findAll('input');

    for (let i = 0; i < inputs.length; i++) {
      expect(inputs.at(i).element.value).toEqual('');
    }
    expect(model.test[0].testOne).toEqual('');
    expect(model.test[0].testTwo).toEqual('');
  });

  it('renders entries with values', () => {
    const model = {
      test: [
        {
          testOne: 'One',
          testTwo: 'Two',
        },
      ],
    };
    const component = wrapper(model);
    const inputs = component.findAll('input');

    expect(inputs.at(0).element.value).toEqual('One');
    expect(inputs.at(1).element.value).toEqual('Two');
    expect(model.test[0].testOne).toEqual('One');
    expect(model.test[0].testTwo).toEqual('Two');
  });

  it('modifies entries', async () => {
    const model = createModel();
    const component = wrapper(model);
    const inputs = component.findAll('input');

    await inputs.at(0).setValue('1');
    expect(model.test[0].testOne).toEqual('1');
    await inputs.at(1).setValue('2');
    expect(model.test[0].testTwo).toEqual('2');
  });

  it('adds entries', async () => {
    const model = createModel();
    const component = wrapper(model);
    const addButton = component.find('.btn-primary');

    await addButton.trigger('click');
    expect(model.test.length).toEqual(2);

    const cards = component.findAll('.card');
    expect(cards.length).toEqual(2);
  });

  it('modifies keys correctly', async () => {
    const model = {
      test: [
        {
          testOne: 'One',
          testTwo: 'Two',
        },
        {
          testOne: 1,
          testTwo: 2,
        },
      ],
    };;
    const component = wrapper(model);
    const inputs = component.findAll('input');

    await inputs.at(0).setValue('test1');
    expect(model.test[0].testOne).toEqual('test1');
    expect(model.test[1].testOne).toEqual(1);
    await inputs.at(2).setValue('test2');
    expect(model.test[0].testOne).toEqual('test1');
    expect(model.test[1].testOne).toEqual('test2');
  })

  it('deletes entries', async () => {
    const model = {
      test: [
        {
          testOne: 'One',
          testTwo: 'Two',
        },
        {
          testOne: 1,
          testTwo: 2,
        },
      ],
    };

    const component = wrapper(model);
    const deleteButton = component.find('.btn-danger');
    await deleteButton.trigger('click');
    expect(model.test.length).toEqual(1);

    const cards = component.findAll('.card');
    expect(cards.length).toEqual(1);
  });

  it('renders submodel', async () => {
    const component = mount(DynamicForm, {
      propsData: {
        model: createModel(),
        title: 'Test',
        self: 'test',
        schema,
        subforms,
      },
    });

    const h1 = component.find('h1');
    expect(h1.exists()).toBeTruthy();
    expect(h1.text()).toContain('Test');
    expect(h1.props().model).toBeTruthy();
  });
});
