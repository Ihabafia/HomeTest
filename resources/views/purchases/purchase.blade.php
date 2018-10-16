                            <tr>
                                <td>{{ $purchase->company_name }}</td>
                                <td>{{ $purchase->share_instrument_name }}</td>
                                <td>{{ $purchase->quantity }}</td>
                                <td>{{ $purchase->price }}</td>
                                <td>{{ number_format($purchase->total_investment, 2) }}</td>
                                <td>{{ $purchase->certificate_number }}</td>
                                <td>{{ $purchase->transaction_date->setTimeZone('America/New_York')->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('purchase.edit', $purchase) }}" id="{{ $purchase->id }}" class="btn btn-sm btn-outline-success mr-1 my-0">Edit</a>
                                    <a href="#" data-id="{{ $purchase->id }}" class="btn btn-sm btn-outline-danger delete">Delete</a>
                                </td>
                            </tr>

