import '@testing-library/jest-dom';
import { render } from '@testing-library/react';
import { describe, test, expect, vi } from 'vitest';
import { BrowserRouter } from 'react-router-dom';
import Pagination from '.';
import * as usePaginate from '../../hooks/usePaginate';

const usePaginateSpy = vi.spyOn(usePaginate, 'usePaginate');

const dataMock = {
    meta: {
        current_page: 1,
        per_page: 6,
        total: 50,
    },
    currentPage: 1,
    handleCurrentPage: vi.fn(),
};

describe('<Pagination />', () => {
    test('should render 3 buttons paginations', () => {
        const { getByRole } = render(
            <Pagination meta={dataMock.meta} currentPage={dataMock.currentPage} handleCurrentPage={dataMock.handleCurrentPage} />,
            {
                wrapper: BrowserRouter,
            }
        );

        const btn1 = getByRole('button', { name: '1' });
        const btn2 = getByRole('button', { name: '2' });
        const btn3 = getByRole('button', { name: '3' });

        expect(btn1).toBeInTheDocument();
        expect(btn2).toBeInTheDocument();
        expect(btn3).toBeInTheDocument();
    });

    test('should render 1 buttons when total is 1', () => {
        const _dataMock = {
            ...dataMock,
            meta: {
                current_page: 1,
                per_page: 6,
                total: 1,
            },
        };
        const { getByRole } = render(
            <Pagination meta={_dataMock.meta} currentPage={_dataMock.currentPage} handleCurrentPage={_dataMock.handleCurrentPage} />,
            {
                wrapper: BrowserRouter,
            }
        );

        const btn1 = getByRole('button', { name: '1' });

        expect(btn1).toBeInTheDocument();
    });
});
