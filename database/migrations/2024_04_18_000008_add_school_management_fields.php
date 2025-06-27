<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSchoolManagementFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('schools')) {
            Schema::table('schools', function (Blueprint $table) {
                // Additional identification
                if (!Schema::hasColumn('schools', 'tax_id')) {
                    $table->string('tax_id')->nullable()->after('registration_number');
                }
                
                // Additional contact information
                if (!Schema::hasColumn('schools', 'website')) {
                    $table->string('website')->nullable()->after('email');
                }
                if (!Schema::hasColumn('schools', 'contact_person')) {
                    $table->string('contact_person')->nullable()->after('website');
                }
                if (!Schema::hasColumn('schools', 'contact_phone')) {
                    $table->string('contact_phone')->nullable()->after('contact_person');
                }
                
                // Location details
                if (!Schema::hasColumn('schools', 'gps_coordinates')) {
                    $table->string('gps_coordinates')->nullable()->after('address');
                }
                
                // Additional operational details
                if (!Schema::hasColumn('schools', 'ownership_type')) {
                    $table->string('ownership_type')->nullable()->after('school_type');
                }
                if (!Schema::hasColumn('schools', 'accreditation_status')) {
                    $table->string('accreditation_status')->nullable()->after('ownership_type');
                }
                if (!Schema::hasColumn('schools', 'accreditation_expiry')) {
                    $table->date('accreditation_expiry')->nullable()->after('accreditation_status');
                }
                
                // Additional capacity and statistics
                if (!Schema::hasColumn('schools', 'student_capacity')) {
                    $table->integer('student_capacity')->nullable()->after('total_students');
                }
                if (!Schema::hasColumn('schools', 'teacher_capacity')) {
                    $table->integer('teacher_capacity')->nullable()->after('total_teachers');
                }
                
                // Additional infrastructure
                if (!Schema::hasColumn('schools', 'classroom_count')) {
                    $table->integer('classroom_count')->nullable()->after('facilities');
                }
                if (!Schema::hasColumn('schools', 'has_library')) {
                    $table->boolean('has_library')->default(false)->after('classroom_count');
                }
                if (!Schema::hasColumn('schools', 'has_laboratory')) {
                    $table->boolean('has_laboratory')->default(false)->after('has_library');
                }
                if (!Schema::hasColumn('schools', 'has_sports_facility')) {
                    $table->boolean('has_sports_facility')->default(false)->after('has_laboratory');
                }
                
                // Additional performance tracking
                if (!Schema::hasColumn('schools', 'pass_rate')) {
                    $table->decimal('pass_rate', 5, 2)->nullable()->after('performance_metrics');
                }
                if (!Schema::hasColumn('schools', 'ranking')) {
                    $table->integer('ranking')->nullable()->after('pass_rate');
                }
            });

            // Add indexes for frequently queried fields
            Schema::table('schools', function (Blueprint $table) {
                if (!Schema::hasColumn('schools', 'tax_id_index')) {
                    $table->index('tax_id');
                }
                if (!Schema::hasColumn('schools', 'website_index')) {
                    $table->index('website');
                }
                if (!Schema::hasColumn('schools', 'ownership_type_index')) {
                    $table->index('ownership_type');
                }
                if (!Schema::hasColumn('schools', 'accreditation_status_index')) {
                    $table->index('accreditation_status');
                }
                if (!Schema::hasColumn('schools', 'pass_rate_index')) {
                    $table->index('pass_rate');
                }
                if (!Schema::hasColumn('schools', 'ranking_index')) {
                    $table->index('ranking');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('schools')) {
            Schema::table('schools', function (Blueprint $table) {
                // Drop indexes if they exist
                if (Schema::hasColumn('schools', 'tax_id_index')) {
                    $table->dropIndex(['tax_id']);
                }
                if (Schema::hasColumn('schools', 'website_index')) {
                    $table->dropIndex(['website']);
                }
                if (Schema::hasColumn('schools', 'ownership_type_index')) {
                    $table->dropIndex(['ownership_type']);
                }
                if (Schema::hasColumn('schools', 'accreditation_status_index')) {
                    $table->dropIndex(['accreditation_status']);
                }
                if (Schema::hasColumn('schools', 'pass_rate_index')) {
                    $table->dropIndex(['pass_rate']);
                }
                if (Schema::hasColumn('schools', 'ranking_index')) {
                    $table->dropIndex(['ranking']);
                }

                // Drop columns if they exist
                $columnsToDrop = [
                    'tax_id',
                    'website',
                    'contact_person',
                    'contact_phone',
                    'gps_coordinates',
                    'ownership_type',
                    'accreditation_status',
                    'accreditation_expiry',
                    'student_capacity',
                    'teacher_capacity',
                    'classroom_count',
                    'has_library',
                    'has_laboratory',
                    'has_sports_facility',
                    'pass_rate',
                    'ranking'
                ];

                foreach ($columnsToDrop as $column) {
                    if (Schema::hasColumn('schools', $column)) {
                        $table->dropColumn($column);
                    }
                }
            });
        }
    }
} 