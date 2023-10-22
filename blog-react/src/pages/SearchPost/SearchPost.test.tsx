import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import SearchPost from '.';
import * as useApiRequest from '../../hooks/useApiRequest';

const useApiRequestSpy = vi.spyOn(useApiRequest, 'useApiRequests');

const dataSpy = {
    data: {
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
    },
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

        expect(getByText(dataSpy.data.data[0].title)).toBeInTheDocument();
    });

    test('Should display error if api response error', () => {
        const _dataSpy = {
            ...dataSpy,
            error: true,
        };
        useApiRequestSpy.mockReturnValue(_dataSpy);
        const { getByTestId } = renderedComponent();

        expect(getByTestId('error')).toBeInTheDocument();
    });

    test('Should display loading if api response is loading', () => {
        const _dataSpy = {
            ...dataSpy,
            isLoading: true,
        };
        useApiRequestSpy.mockReturnValue(_dataSpy);
        const { getByTestId } = renderedComponent();

        expect(getByTestId('loading')).toBeInTheDocument();
    });
});
