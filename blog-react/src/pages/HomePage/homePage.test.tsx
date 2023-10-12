import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import { faker } from '@faker-js/faker';
import HomePage from '.';
import * as useApiRequest from '../../hooks/useApiRequest';

const useApiRequestSpy = vi.spyOn(useApiRequest, 'useApiRequests');

const dataSpy = {
    data: [{ id: 1, title: 'test-title', description: faker.lorem }],
    error: false,
    fetchData: vi.fn(),
    isLoading: true,
};

const renderedComponent = () => {
    return render(
        <BrowserRouter>
            <HomePage />
        </BrowserRouter>
    );
};

describe('HomePage', () => {
    test('HomePage header link exist', () => {
        const _dataSpy = {
            ...dataSpy,
            isLoading: false,
        };

        useApiRequestSpy.mockReturnValue(_dataSpy);

        const { getByText } = renderedComponent();

        const headerLink = getByText(/Derniers articles/i);

        expect(headerLink).toBeInTheDocument();
    });

    test('should display loading...', () => {
        const _dataSpy = {
            ...dataSpy,
            isLoading: true,
        };

        useApiRequestSpy.mockReturnValue(_dataSpy);

        const { getByTestId } = renderedComponent();

        const loading = getByTestId('loading');

        expect(loading).toBeInTheDocument();
    });

    test('PostsListComponents should display posts', async () => {
        const _dataSpy = {
            ...dataSpy,
            isLoading: false,
        };

        useApiRequestSpy.mockReturnValue(_dataSpy);

        const { findAllByRole } = renderedComponent();

        const listItems = await findAllByRole('listitem');

        expect(listItems).toHaveLength(1);
    });

    test('PostsListComponents should display errors', () => {
        const _dataSpy = {
            ...dataSpy,
            isLoading: false,
            error: true,
        };

        useApiRequestSpy.mockReturnValue(_dataSpy);

        const { getByTestId } = renderedComponent();

        const error = getByTestId('error');

        expect(error).toBeInTheDocument();
    });
});
