import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import PostsList from './PostsList';

const dataSpy = {
    data: [{ id: 1, title: 'test-title', content: 'test-description', medias: [] }],
    error: false,
    fetchData: vi.fn(),
    isLoading: true,
};

describe('<PostsList>', () => {
    test('should display placeholder image if not image from api', () => {
        const _dataSpy = {
            ...dataSpy,
            isLoading: false,
            error: false,
        };

        const { getByRole } = render(
            <BrowserRouter>
                <PostsList data={_dataSpy.data} error={_dataSpy.error} isLoading={_dataSpy.isLoading} />
            </BrowserRouter>
        );

        const img: any = getByRole('img');

        const imgPlaceholderName = img.src.split('assets');

        expect(imgPlaceholderName[1]).toEqual('/placeholder-image.png');
    });

    test('should display image from api', () => {
        const _dataSpy = {
            ...dataSpy,
            data: [
                {
                    id: 1,
                    title: 'test-title',
                    content: 'test-description',
                    medias: [{ id: 1, name: '', path: 'http://api/assets/api-image.png' }],
                },
            ],
            isLoading: false,
            error: false,
        };

        const { getByRole } = render(
            <BrowserRouter>
                <PostsList data={_dataSpy.data} error={_dataSpy.error} isLoading={_dataSpy.isLoading} />
            </BrowserRouter>
        );

        const img: any = getByRole('img');

        const imgPlaceholderName = img.src.split('assets');

        expect(imgPlaceholderName[1]).toEqual('/api-image.png');
    });
});