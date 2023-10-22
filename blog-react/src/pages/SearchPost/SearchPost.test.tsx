import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import SearchPost from '.';
import * as useApiRequest from '../../hooks/useApiRequest';

const useApiRequestSpy = vi.spyOn(useApiRequest, 'useApiRequests');

const dataSpy = {
    data: [
        {
            id: 1,
            title: 'test-title',
            content: 'test content',
            medias: [],
            author: { id: 1, name: 'test-author' },
            created_at: '2023-10-12T21:24:18.000000Z',
        },
    ],
    error: false,
    fetchData: vi.fn(),
    isLoading: false,
};

const renderedComponent = () => {
    return render(<SearchPost />, { wrapper: BrowserRouter });
};

describe('<SearchPost>', () => {
    test('Should display initial value post title', () => {
        useApiRequestSpy.mockReturnValue(dataSpy);
        const { getByText } = renderedComponent();

        expect(getByText(dataSpy.data[0].title)).toBeInTheDocument();
    });
});
