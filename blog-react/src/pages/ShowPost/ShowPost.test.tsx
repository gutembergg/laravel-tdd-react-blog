import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import ShowPost from '.';
import * as useApiRequest from '../../hooks/useApiRequest';

const useApiRequestSpy = vi.spyOn(useApiRequest, 'useApiRequests');

const mockDateUTC = '2023-10-12T21:24:18.000000Z';
const expectMockDateFormated = 'jeudi 12 octobre 2023';

const dataSpy = {
    data: {
        id: 1,
        title: 'test-title',
        content: 'test content',
        medias: [],
        author: { id: 1, name: 'test-author' },
        created_at: mockDateUTC,
    },
    error: false,
    fetchData: vi.fn(),
    isLoading: false,
};

const renderedComponent = () => {
    /*   render(
        <MemoryRouter initialEntries={[`/products/${1}`]}>
            <Routes>
                <Route path="/products/:id" element={<ShowPost />} />
            </Routes>
        </MemoryRouter>
    ); */
    return render(<ShowPost />, { wrapper: BrowserRouter });
};

describe('Show page', () => {
    test('should display attributes page without medias', () => {
        useApiRequestSpy.mockReturnValue(dataSpy);

        const { getByText, getByTestId } = renderedComponent();

        const img: any = getByTestId('postHeader');
        const imgPlaceholderName = img.src.split('/').pop();

        expect(imgPlaceholderName).toEqual('placeholder-image.png');
        expect(getByText(dataSpy.data.title)).toBeInTheDocument();
        expect(getByText(dataSpy.data.content)).toBeInTheDocument();
        expect(getByText(expectMockDateFormated)).toBeInTheDocument();
        expect(getByText(dataSpy.data.author.name)).toBeInTheDocument();
    });

    test('should display attributes page with medias', () => {
        const _dataSpy = {
            ...dataSpy,
            data: {
                ...dataSpy.data,
                medias: [{ id: 1, name: 'test-img', path: 'test-img.png' }],
            },
        };
        useApiRequestSpy.mockReturnValue(_dataSpy);

        const { getByText, getByTestId } = renderedComponent();

        const img: any = getByTestId('postHeader');
        const imgPlaceholderName = img.src.split('/').pop();

        expect(imgPlaceholderName).toEqual('test-img.png');
        expect(getByText(dataSpy.data.title)).toBeInTheDocument();
        expect(getByText(dataSpy.data.content)).toBeInTheDocument();
        expect(getByText(expectMockDateFormated)).toBeInTheDocument();
        expect(getByText(dataSpy.data.author.name)).toBeInTheDocument();
    });

    test('should display Not found and error true', () => {
        const _dataSpy = {
            ...dataSpy,
            data: {
                error: true,
                message: 'Not found',
            },
            error: true,
        };
        useApiRequestSpy.mockReturnValue(_dataSpy);

        const { getByText } = renderedComponent();

        expect(getByText('Not found')).toBeInTheDocument();
    });

    test('should display Loading', () => {
        const _dataSpy = {
            ...dataSpy,
            isLoading: true,
        };
        useApiRequestSpy.mockReturnValue(_dataSpy);

        const { getByText } = renderedComponent();

        expect(getByText('Loading...')).toBeInTheDocument();
    });
});
