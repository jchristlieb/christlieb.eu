import {shallow} from '@vue/test-utils';
import flash from '../../resources/assets/js/services/flash';
jest.mock('flash');
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

    it('can update the tag', async () => {
        wrapper.vm.patch = jest.fn().mockImplementation(() => {
            return Promise.resolve({data: {name: 'new name'}});
        });

        wrapper.vm.tag.name = 'new name';

        await wrapper.vm.update();

        expect(wrapper.vm.tag.name).toEqual('new name');
        expect(wrapper.vm.patch).toBeCalledWith('/admin/tags/1', {name: 'new name'})
    });

    it('wont update on error', async () => {
        wrapper.vm.patch = jest.fn().mockImplementation(() => {
            return Promise.reject({
                response:{
                    data:{
                        errors:{
                            name: ['name error']
                        }
                    }
                }
            });
        });

        await wrapper.vm.update();

        expect(wrapper.vm.tag.name).not.toEqual('new name');
        expect(wrapper.vm.errors).not.toEqual(false);
        expect(wrapper.find('.invalid-feedback').exists()).toBe(false)
    });
});
