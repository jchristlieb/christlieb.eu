import {shallow} from '@vue/test-utils';
import TagsWidget from '../../resources/assets/js/components/TagsWidget.vue';

describe('TagsWidget', () => {
    let wrapper;

    const testData = [
        {
            'name': 'laravel',
            'slug': 'laravel',
            'articles_count': 5,
        },
        {
            'name': 'php',
            'slug': 'php',
            'articles_count': 10,
        },
        {
            'name': 'vue',
            'slug': 'vue',
            'articles_count': 15,
        },
    ];
    beforeEach(() => {
        wrapper = shallow(TagsWidget, {
            propsData: {
                dataTags: JSON.stringify(testData)
            }
        });
    });

    it('should correctly calculates maxCount', () => {
        expect(wrapper.vm.maxCount).toBe(15);
    });

    it('should correctly calculates minCount', () => {
        expect(wrapper.vm.minCount).toBe(5);
    });

    it('should correctly calculates font size', () => {
        expect(wrapper.vm.getFontSize(testData[0])).toBe("10px");
        expect(wrapper.vm.getFontSize(testData[2])).toBe("25px");
    });
});
