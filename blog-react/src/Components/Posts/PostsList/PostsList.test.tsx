import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import PostsList from './PostsList';

const dataSpy = {
    data: [
        {
            id: 1,
            title: 'test-title',
            content: 'test-description',
            mediaPath: '',
            slug: 'test-slug',
            author: 'test-author',
        },
    ],
    error: false,
    fetchData: vi.fn(),
    isLoading: true,
};

describe('<PostsList>', () => {
    test('should display placeholder image if not image from api', () => {
        const _dataSpy = {
            ...dataSpy,
            data: [
                {
                    id: 1,
                    title: 'test-title',
                    content: 'test-description',
                    slug: 'test-slug',
                    author: { id: 1, name: 'test-author' },
                    medias: [],
                },
            ],
            isLoading: false,
            error: false,
        };

        const { getByRole } = render(
            <BrowserRouter>
                <PostsList data={_dataSpy.data} />
            </BrowserRouter>
        );

        const img: any = getByRole('img');

        const imgPlaceholderName = img.src.split('/').pop();

        expect(imgPlaceholderName).toEqual('placeholder-image.png');
    });

    test('should display image from api', () => {
        const _dataSpy = {
            ...dataSpy,
            data: [
                {
                    id: 1,
                    title: 'test-title',
                    content: 'test-description',
                    slug: 'test-slug',
                    author: { id: 1, name: 'test-author' },
                    medias: [{ id: 1, path: 'http://api/assets/api-image.png', name: 'test-image' }],
                },
            ],
            isLoading: false,
            error: false,
        };

        const { getByRole } = render(
            <BrowserRouter>
                <PostsList data={_dataSpy.data} />
            </BrowserRouter>
        );

        const img: any = getByRole('img');

        const imgPlaceholderName = img.src.split('/').pop();

        expect(imgPlaceholderName).toEqual('api-image.png');
    });
});
