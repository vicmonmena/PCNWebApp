<?php

use app\models\User;
use app\models\Role;
use app\models\Empresa;
use app\models\Proceso;
use yii\db\Schema;
use yii\db\Migration;

class m150214_044831_init_user extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        // create tables. note the specific order
        $this->createTable('{{%role}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' not null',
            'create_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'update_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'can_admin' => Schema::TYPE_SMALLINT . ' not null default 0',
        ], $tableOptions);
		$this->createTable('{{%empresa}}', [
            'id' => Schema::TYPE_PK,
            'nombre' => Schema::TYPE_STRING . ' not null',
			'web' => Schema::TYPE_STRING . ' null default null',
            'fecha_creacion' => Schema::TYPE_TIMESTAMP . ' null default null',
            'fecha_modificacion' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
		$this->createTable('{{%proceso}}', [
            'id' => Schema::TYPE_PK,
            'nombre' => Schema::TYPE_STRING . ' not null',
            'fecha_creacion' => Schema::TYPE_TIMESTAMP . ' null default null',
            'fecha_modificacion' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'role_id' => Schema::TYPE_INTEGER . ' not null',
            'status' => Schema::TYPE_SMALLINT . ' not null',
            'email' => Schema::TYPE_STRING . ' null default null',
            'new_email' => Schema::TYPE_STRING . ' null default null',
            'username' => Schema::TYPE_STRING . ' null default null',
            'password' => Schema::TYPE_STRING . ' null default null',
            'auth_key' => Schema::TYPE_STRING . ' null default null',
            'api_key' => Schema::TYPE_STRING . ' null default null',
            'login_ip' => Schema::TYPE_STRING . ' null default null',
            'login_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'create_ip' => Schema::TYPE_STRING . ' null default null',
            'create_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'update_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'ban_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'ban_reason' => Schema::TYPE_STRING . ' null default null',
			'nombre' => Schema::TYPE_STRING . ' null default null',
			'apellidos' => Schema::TYPE_STRING . ' null default null',
			'telefono' => Schema::TYPE_STRING . ' null default null',
			'movil' => Schema::TYPE_STRING . ' null default null',
			'empresa' => Schema::TYPE_INTEGER . ' not null',
			'proceso' => Schema::TYPE_INTEGER . ' not null',
        ], $tableOptions);
        $this->createTable('{{%user_key}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' not null',
            'type' => Schema::TYPE_SMALLINT . ' not null',
            'key_value' => Schema::TYPE_STRING . ' not null',
            'create_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'consume_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'expire_time' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
        $this->createTable('{{%profile}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' not null',
            'create_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'update_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'full_name' => Schema::TYPE_STRING . ' null default null',
        ], $tableOptions);
        $this->createTable('{{%user_auth}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' not null',
            'provider' => Schema::TYPE_STRING . ' not null',
            'provider_id' => Schema::TYPE_STRING . ' not null',
            'provider_attributes' => Schema::TYPE_TEXT . ' not null',
            'create_time' => Schema::TYPE_TIMESTAMP . ' null default null',
            'update_time' => Schema::TYPE_TIMESTAMP . ' null default null'
        ], $tableOptions);
		$this->createTable('{{%ubicacion}}', [
            'id' => Schema::TYPE_PK,
            'nombre' => Schema::TYPE_STRING . ' not null',
            'fecha_creacion' => Schema::TYPE_TIMESTAMP . ' null default null',
            'fecha_modificacion' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
		$this->createTable('{{%notificacion}}', [
            'id' => Schema::TYPE_PK,
            'motivo' => Schema::TYPE_STRING . ' not null',
			'ubicacion' => Schema::TYPE_INTEGER . ' not null',
            'fecha_creacion' => Schema::TYPE_TIMESTAMP . ' null default null',
            'fecha_modificacion' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
		$this->createTable('{{%accion}}', [
            'id' => Schema::TYPE_PK,
            'procedimiento' => Schema::TYPE_STRING . ' not null',
            'fecha_creacion' => Schema::TYPE_TIMESTAMP . ' null default null',
            'fecha_modificacion' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
		$this->createTable('{{%usuario_notificacion}}', [
            'id' => Schema::TYPE_PK,
			'emisor' => Schema::TYPE_INTEGER . ' not null',
			'destinatario' => Schema::TYPE_INTEGER . ' not null',
			'notificacion' => Schema::TYPE_INTEGER . ' not null',
			'codigo' => Schema::TYPE_STRING . ' not null',
			'atendida' => Schema::TYPE_BOOLEAN,
			'fecha_creacion' => Schema::TYPE_TIMESTAMP . ' null default null',
            'fecha_modificacion' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
		$this->createTable('{{%usuario_accion}}', [
            'id' => Schema::TYPE_PK,
            'emisor' => Schema::TYPE_INTEGER . ' not null',
			'destinatario' => Schema::TYPE_INTEGER . ' not null',
			'accion' => Schema::TYPE_INTEGER . ' not null',
			'fecha_creacion' => Schema::TYPE_TIMESTAMP . ' null default null',
            'fecha_modificacion' => Schema::TYPE_TIMESTAMP . ' null default null',
        ], $tableOptions);
		
        // add indexes for performance optimization
        $this->createIndex('{{%user_email}}', '{{%user}}', 'email', true);
        $this->createIndex('{{%user_username}}', '{{%user}}', 'username', true);
        $this->createIndex('{{%user_key_key}}', '{{%user_key}}', 'key_value', true);
        $this->createIndex('{{%user_auth_provider_id}}', '{{%user_auth}}', 'provider_id', false);

        // add foreign keys for data integrity
        $this->addForeignKey('{{%user_role_id}}', '{{%user}}', 'role_id', '{{%role}}', 'id');
        $this->addForeignKey('{{%profile_user_id}}', '{{%profile}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('{{%user_key_user_id}}', '{{%user_key}}', 'user_id', '{{%user}}', 'id');
        $this->addForeignKey('{{%user_auth_user_id}}', '{{%user_auth}}', 'user_id', '{{%user}}', 'id');

		$this->addForeignKey('{{%user_empresa}}', '{{%user}}', 'empresa', '{{%empresa}}', 'id');
		$this->addForeignKey('{{%user_proceso}}', '{{%user}}', 'proceso', '{{%proceso}}', 'id');
		$this->addForeignKey('{{%notificacion_ubicacion}}', '{{%notificacion}}', 'ubicacion', '{{%ubicacion}}', 'id');
		
		$this->addForeignKey('{{%usu_notif_emisor}}', '{{%usuario_notificacion}}', 'emisor', '{{%user}}', 'id');
		$this->addForeignKey('{{%usu_notif_destinatario}}', '{{%usuario_notificacion}}', 'destinatario', '{{%user}}', 'id');
		$this->addForeignKey('{{%usu_notif_notificacion}}', '{{%usuario_notificacion}}', 'notificacion', '{{%notificacion}}', 'id');
		
		$this->addForeignKey('{{%usu_acc_pers_critico}}', '{{%usuario_accion}}', 'destinatario', '{{%user}}', 'id');
		$this->addForeignKey('{{%usu_acc_accion}}', '{{%usuario_accion}}', 'accion', '{{%accion}}', 'id');
		$this->addForeignKey('{{%usu_acc_directivo}}', '{{%usuario_accion}}', 'emisor', '{{%user}}', 'id');		
		
        // insert role data
        $columns = ['name', 'can_admin', 'create_time'];
        $this->batchInsert('{{%role}}', $columns, [
            ['Admin', 1, date('Y-m-d H:i:s')],
			['User', 0, date('Y-m-d H:i:s')],
			['Director', 0, date('Y-m-d H:i:s')],
			['Notifier', 0, date('Y-m-d H:i:s')],
        ]);

		// insert role data
        $columns = ['nombre', 'web', 'create_time'];
        $this->batchInsert('{{%empresa}}', $columns, [
            ['Telefónica S.A.', 'http://telefonica.telefonica/intranet/index.shtml', date('Y-m-d H:i:s')],
        ]);
		
		// insert role data
        $columns = ['nombre', 'create_time'];
        $this->batchInsert('{{%proceso}}', $columns, [
            ['Administrador', date('Y-m-d H:i:s')],
        ]);
		
        // insert admin user: admin/admin
        $security = Yii::$app->security;
        $columns = ['role_id', 'empresa', 'proceso', 'email', 'username', 'password', 'status', 'create_time', 'api_key', 'auth_key'];
        $this->batchInsert('{{%user}}', $columns, [
            [
                Role::ROLE_ADMIN,
				Empresa::EMPRESA_TELEFONICA_SA,
				Proceso::PROCESO_ADMIN,
                'admin@telefonica.com',
                'admin',
                '$2y$13$dyVw4WkZGkABf2UrGWrhHO4ZmVBv.K4puhOL59Y9jQhIdj63TlV.O',
                User::STATUS_ACTIVE,
                date('Y-m-d H:i:s'),
                $security->generateRandomString(),
                $security->generateRandomString(),
            ],
        ]);

        // insert profile data
        $columns = ['user_id', 'full_name', 'create_time'];
        $this->batchInsert('{{%profile}}', $columns, [
            [1, 'the one', date('Y-m-d H:i:s')],
        ]);
    }

    public function safeDown()
    {
        // drop tables in reverse order (for foreign key constraints)
        $this->dropTable('{{%user_auth}}');
        $this->dropTable('{{%profile}}');
        $this->dropTable('{{%user_key}}');
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%role}}');
		$this->dropTable('{{%proceso}}');
		$this->dropTable('{{%empresa}}');
		$this->dropTable('{{%ubicacion}}');
		$this->dropTable('{{%notificacion}}');
		$this->dropTable('{{%accion}}');
		$this->dropTable('{{%usuario_notificacion}}');
		$this->dropTable('{{%usuario_accion}}');
    }
}
