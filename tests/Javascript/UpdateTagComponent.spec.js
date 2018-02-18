jest.mock('axios', () => ({
    patch: jest.fn(() => Promise.resolve({data:{name: 'new name'}}))
}));

import axios from 'axios'
import {shallow} from '@vue/test-utils';
import UpdateTagComponent from '../../resources/assets/js/components/UpdateTagComponent.vue';

describe('UpdateTagComponent', () => {
    let wrapper;

    beforeEach(() => {
        wrapper = shallow(UpdateTagComponent, {
            propsData: {
                dataTag: JSON.stringify({name: 'Test Tag'}),
                url: '/admin/tags/1'
            }
        });
        jest.resetModules();
        jest.clearAllMocks();
    });

    it('can toggle edit', () => {
        expect(wrapper.vm.edit).toBe(false);
        expect(wrapper.find('input').exists()).toBe(false);

        wrapper.find('button').trigger('click');

        expect(wrapper.vm.edit).toBe(true);
        expect(wrapper.find('input').exists()).toBe(true);
    });

    it('can update the tag', async () => {
        wrapper.vm.tag.name = 'new name';

        await wrapper.vm.update();

        expect(wrapper.vm.tag.name).toEqual('new name');
        expect(axios.patch).toBeCalledWith('/admin/tags/1', {name: 'new name'})
    });
});
