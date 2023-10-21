import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import ShowPost from '.';
import * as useApiRequest from '../../hooks/useApiRequest';

const useApiRequestSpy = vi.spyOn(useApiRequest, 'useApiRequests');

const mockDateUTC = '2023-10-12T21:24:18.000000Z';
const mockDateFormated = 'jeudi 12 octobre 2023';

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
    isLoading: true,
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
    test('should display attributes page', () => {
        useApiRequestSpy.mockReturnValue(dataSpy);

        const { getByText } = renderedComponent();

        expect(getByText(dataSpy.data.title)).toBeInTheDocument();
        expect(getByText(dataSpy.data.content)).toBeInTheDocument();
        expect(getByText(mockDateFormated)).toBeInTheDocument();
        expect(getByText(dataSpy.data.author.name)).toBeInTheDocument();
    });
});
